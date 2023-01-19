/*
When user clicks on right nav elements UI needs to respond accordingly
  - Background for appropriate button needs to darken
  - Old container needs to fade out
  - New container needs to fade in
 */

function clearActivePanels($) {
    $('.hidden-panel').collapse('hide');
    $('.navButton').removeClass('active');
}

function scrollToTop() {
    document.documentElement.scrollTo({
        top: 0,
        behavior: "smooth"
    })
}


jQuery(document).ready(function($) {


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    //Toggle visiblity of nav panels
    $('#events-toggle').click(function() {
        scrollToTop();
       clearActivePanels($);
       $('#events-container').collapse('show');
       $('#events-toggle').addClass('active');
    });

    $('#mintranets-toggle').click(function() {
        scrollToTop();
        clearActivePanels($)
       $('#mintranets-container').collapse('show');
       $('#mintranets-toggle').addClass('active');
    });

    $('#externals-toggle').click(function() {
        scrollToTop();
        clearActivePanels($)
        $('#externals-container').collapse('show');
        $('#externals-toggle').addClass('active');
    });

    $('#infotech-toggle').click(function() {
        scrollToTop();
        clearActivePanels($)
        $('#infotech-container').collapse('show');
        $('#infotech-toggle').addClass('active');
    })



});



