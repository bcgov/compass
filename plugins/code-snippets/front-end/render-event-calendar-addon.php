<?php

/**
 * Load and Render Event Data from Calendar
 *
 * This is a script for loading the event data from the locally stored Events JSON file. This snippet is run on the front-end, and provides the data for an event widget.
 */
add_filter( 'tec_views_v2_use_subscribe_links', '__return_false' );
add_action( 'wp_head', function () { ?>
<script>
	
(function($) {	


/**
 * Fetches event data from events calendar REST API, using current date, and calls page-loading 
 * @param {String} url provides the url location to be used for fetching events JSON
 * @returns rendered events on DOM through calling of getEventData function on JSON response 
 */
	
function eventLoadDisplay(url) {
    fetch(url)
    .then(res => res.json())
    .then(out => data = out)
    .then(() =>

    getEventData(data)
    )
}
	
//array for holding all parsed event data pending generation of event list accordion	
const accordionList = [];

//helper function to set multiple attributes at once
function setAttributes(el, attrs) {
    for(const key in attrs) {
        el.setAttribute(key, attrs[key]);
    }
}
	
	
/**
 * Uses event data to generate list of events
 * @param {Object} eventData is a JSON string of events from the events calendar, parsed as an object
 */
function getEventData(eventData) {

	const inputList = document.createElement('input');
	inputList.setAttribute('id', 'search-bar');
	inputList.setAttribute('list', 'datalist-categories');
	inputList.setAttribute('name', 'search-bar');
	inputList.setAttribute('type', 'search');
	inputList.setAttribute('placeholder', 'Search Upcoming Events');
	const searchLabel = document.createElement('label');
	searchLabel.style.cssText += "width:100%"
	const datalist = document.createElement('datalist');
	datalist.innerHTML = "<option value=''>----</option>";
	datalist.setAttribute('id', 'datalist-categories');
	
	let length = Object.keys(eventData['events']);
    eventData['events'].forEach(element => {
        const { title, start_date, slug, end_date, website, description, excerpt, categories } = element;
        const urlPrepend = "https://compass.gww.gov.bc.ca/event/"
        const start = start_date.slice(0,10);
        const end = end_date.slice(0,10);
        const url = `${urlPrepend}${slug}/`;
        const blurb = description.slice(0,450);
		const excerptBlurb = excerpt.slice(0,450);
        const tagChain = categories;
        const site = website;
        const event = {title, url, start, end, site, blurb, excerptBlurb, tagChain};

        addEventToTable(event, 'eventData', datalist);
    })
	
	//adds category-searching to drop-list of search bar
	//requires DOM element with id 'search-form' to render 
	const searchButton = document.createElement('button');
	searchButton.innerHTML = "<a style='color:white;text-decoration:none' href='https://compass.gww.gov.bc.ca/events/list/'>search</a>";
	searchButton.style.cssText += "width:30%;padding:inherit;padding-top:.2em;border:none;height:1.892em";
	searchLabel.appendChild(inputList);
	searchLabel.appendChild(searchButton);
	document.getElementById('search-form').appendChild(searchLabel);
	document.getElementById('search-bar').appendChild(datalist);
	const tagSelection = document.getElementById('search-bar');
	tagSelection.addEventListener('input', function() {
		let text = this.value;
		const present = $('.presentEvent');
		const future = $('.futureEvent');
		$('.event-content').collapse("hide"); 	
		future.hide();
		present.hide();
		
		const textClassReplace = text.replace(/\s+/g, '-').toLowerCase();
		
		if(text && ($("div").hasClass('futureEvent') || $("div").hasClass('presentEvent')) && ($("div").hasClass(textClassReplace))){
			$("." + textClassReplace).show();
		} else {
			present.show();
		}

	});
	
	
	//creates dynamic search bar for events

		const filter = document.getElementById('search-bar');
		filter.style.cssText += "width:70%;border:none";
		filter.addEventListener('input', function() {
			let text = String($(this).val());
			text = text.toLowerCase();
			searchButton.innerHTML = `<a style='color: white;text-decoration:none' href='https://compass.gww.gov.bc.ca/events/list/?tribe-bar-search=${text}'>search</a>`;
			const searchString = ".presentEvent:contains('" + text + "')";
			const searchTD = ".futureEvent:contains('" + text + "')";
			const upperText = text[0] ? text[0].toUpperCase() + text.slice(1) : "";
			const searchStringUpper = ".presentEvent:contains('" + upperText + "')";
			const searchTDUpper = ".futureEvent:contains('" + upperText + "')";
			
			const present = $('.presentEvent');
			const future = $('.futureEvent');
			
			$('.event-content').collapse("hide"); 	
			present.hide();
			future.hide();
			
			if(text === ""){
			present.hide();
			future.hide();
			present.show();	
			} else if($(searchString) || $(searchStringUpper) || $(searchTD)|| $(searchTDUpper)){
				$(searchString).show();
				$(searchStringUpper).show();	
				$(searchTD).show();	
				$(searchTDUpper).show();
			}
			
			const textClassReplace = text.replace(/\s+/g, '-').toLowerCase();
	
			//Searches by tags on events
			if(text && ($("div").hasClass('futureEvent') || $("div").hasClass('presentEvent')) && ($("div").hasClass(textClassReplace) || $("div").hasClass(upperText))){
				$("." + textClassReplace).show();
				$("." + upperText).show();
			}
		});
	
		accordionCreate(accordionList, 'eventData');
	
	
		const eventsButton = document.createElement('button');
		const eventsButtonFlexDiv = document.createElement('div');
		eventsButtonFlexDiv.style.cssText += "display:flex;justify-content:end;border:none";
		eventsButton.classList.add("allevents-button");
		eventsButton.style.cssText += "border:none";
		eventsButton.innerHTML = '<a style="color: white;text-decoration: none" href="https://compass.gww.gov.bc.ca/events/">View Calendar</a>';
		eventsButtonFlexDiv.appendChild(eventsButton);
		const parent = document.getElementById('eventData');
	    parent.appendChild(eventsButtonFlexDiv);
	
	
}
	
/**
 *
 * @param item {array} An array of event objects which provide a name, description and link to accordion component
 * @param parentAccordion {string} provides the id of the DOM object to append the created accordion section to
 * @returns accordion object rendered to dom
 */
const accordionCreate = function(item, parentAccordion){
    for(let i =0; i<item.length; i++){
		if(item[i].date){
			const dateHeader = document.createElement('h2');
			dateHeader.innerText = item[i].date;
			dateHeader.classList.add(item[i].class);
			dateHeader.style.cssText += "font-size:1.5rem;color:white;font-family:'Noto Sans',sans-serif";
			const parent = document.getElementById(parentAccordion);
	        parent.appendChild(dateHeader);
		} else {
        const card = document.createElement('div');
		card.style.cssText += "background-color:#5d5d5d;margin-bottom:.5em";
        card.classList.add("card", item[i].class, 'rounded-0');
		if((item[i].category).length > 0){
			for(let each of item[i].category){
				newClass = each.replace(/\s+/g, '-').toLowerCase();
				card.classList.add(newClass);
			}
		}

        const cardHeader = document.createElement('div');
		cardHeader.style.cssText += "padding:0";
        cardHeader.classList.add("card-header");
        cardHeader.setAttribute('id', `heading${i}`)

        const headerText = document.createElement('h5');
        headerText.classList.add("mb-0");

        const button = document.createElement('button');
		button.style.cssText += "width:100%;text-align:left;background-color:#5d5d5d"
        setAttributes(button, {'class': `btn btn-link collapsed`, 'data-toggle': "collapse", 'data-target': `#collapse${i}`, 'aria-expanded': "false",'aria-controls': `collapse${i}`});
        button.innerText = item[i].name;

        const collapseShow = document.createElement('div');
        setAttributes(collapseShow, {'id': `collapse${i}`, 'data-parent': `#${parentAccordion}`, 'aria-labelledby': `heading${i}`});
        collapseShow.classList.add("collapse", "event-content");

        const cardBody = document.createElement('div');
		cardBody.style.cssText += "background-color:white;margin-bottom:.5em"
        cardBody.classList.add("card-body");
			
		const buttonHolder = document.createElement('div');
		buttonHolder.style.cssText += "display:flex"
        buttonHolder.classList.add("button-holder");
			
		const readButton = document.createElement('button');
		readButton.style.cssText += "padding:.5em;border:none"
        readButton.classList.add("read-more");
		if((item[i].description).length > 449){
			cardBody.innerHTML = `${item[i].description}...<br>`;
			readButton.innerHTML = `<a style="color: white;text-decoration: none" href=${item[i].url}>Read More</a><br>`;
			buttonHolder.style.cssText += "justify-content:end;flex-direction:row-reverse;justify-content:space-between"
		} else {
			cardBody.innerHTML = `${item[i].description}<br>`;
			readButton.innerHTML = `<a style="color: white;text-decoration: none" href=${item[i].url}> View Event</a><br>`;
			buttonHolder.style.cssText += "justify-content:end;flex-direction:row-reverse;justify-content:space-between"
		}
		
		const calButton = document.createElement('button');
		calButton.style.cssText += "padding:.5em;border:none"
        calButton.classList.add("add-calendar");
		const webCalendarLink = item[i].url + "?ical=1";
        calButton.innerHTML = `<a style="color: white;text-decoration: none" href=${webCalendarLink}>Add to Outlook</a>`;

		buttonHolder.appendChild(readButton);
		buttonHolder.appendChild(calButton);
		cardBody.appendChild(buttonHolder);

        collapseShow.appendChild(cardBody);

        headerText.appendChild(button);
        cardHeader.appendChild(headerText);
        card.appendChild(cardHeader);

        const parent = document.getElementById(parentAccordion);

		parent.appendChild(card);
        parent.appendChild(collapseShow);
		}
    }

}
		
let eventCounter = 0;
let dateState = "";
let dateDefault = "Today";

/**
 * Uses event data to generate list of events
 * @param {Object} element represents the values parsed from the JSON API response
 * @param {string} tableID takes in the string ID of a table in the DOM
 * @param {Object} datalistMenu is passed down to have category tags appended prior to appending the completed drop table to the DOM
 */
function addEventToTable(element, tableID, datalistMenu) {
    const { title, start, url, end, site, blurb, excerptBlurb, tagChain } = element;

	let currentDate = new Date();
	currentDate.setDate(currentDate.getDate()-1);
	let date_start = new Date(start);
	date_start.setHours(date_start.getHours() + 8);
	const date_end = new Date(end);
	const titleApostropheReplaced = title.replace('&#8217;', "'");
	
	if(date_start < currentDate && date_end < currentDate) {return};
	

	const longDateStart = date_start.toLocaleString('en-CA', { month: 'long' });
	const dayStart = date_start.getUTCDate();
	const datalist = datalistMenu;
	const elementObject = {'name': titleApostropheReplaced, 'description': blurb, 'url': url, 'category': []};
	
	if(excerptBlurb.length > 0) elementObject['description'] = excerptBlurb;
	
	if((date_start <= currentDate || date_start <= new Date()) && date_end >= currentDate) {
		if(dateState !== "Today"){
			accordionList.push({'date': 'Today', 'class': 'presentEvent'});
			dateState = "Today";
		}
		elementObject['class'] = "presentEvent";
		if(tagChain){
		tagChain.forEach(category => {
			elementObject['category'].push(category.name);	
			if((datalist.innerHTML).indexOf(category.name) < 0){
				datalist.innerHTML += '<option value="' + category.name + '">' + category.name + '</option>';
			}	
		});
		}
		accordionList.push(elementObject);
		eventCounter++;
		
	} else if(date_start >= currentDate && eventCounter <= 12) {
		if(dateState !== start){
			accordionList.push({'date': `${longDateStart} ${dayStart}`, 'class': 'presentEvent'});
			dateState = start;
		}
		elementObject['class'] = "presentEvent";
		if(tagChain){
		tagChain.forEach(category => {
			elementObject['category'].push(category.name);	
			if((datalist.innerHTML).indexOf(category.name) < 0){
				datalist.innerHTML += '<option value="' + category.name + '">' + category.name + '</option>';
			}	
		});
		}
		accordionList.push(elementObject);
		eventCounter++;

	} else if(date_start >= currentDate) {
		if(dateState !== start){
			accordionList.push({'date': `${longDateStart} ${dayStart}`, 'class': 'futureEvent'});
			dateState = start;
		}
		elementObject['class'] = "futureEvent";
		if(tagChain){
		tagChain.forEach(category => {
			elementObject['category'].push(category.name);	
			if((datalist.innerHTML).indexOf(category.name) < 0){
				datalist.innerHTML += '<option value="' + category.name + '">' + category.name + '</option>';
			}	
		});
		}
		accordionList.push(elementObject);
	}
}
	
//Waits for page readiness before executing user-facing tasks
var ready = (callback) => {
    if (document.readyState != "loading") callback()
    else document.addEventListener("DOMContentLoaded", callback)
    };

	ready(()=> {
	//This conditional ensures script only executes on pages with events navbar.
		
	//location of local JSON event storage
	const localEventsJSON = '/bitnami/wordpress/wp-content/uploads/wes-2022/event-list.json';
		
	let eventTableExists = document.getElementById('eventData')
	if (eventTableExists != null) {
		eventLoadDisplay((localEventsJSON));
	}	
	})
	
	
})( jQuery );
</script>
<?php } );
