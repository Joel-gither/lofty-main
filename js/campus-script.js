 
$(document).ready(function(){

	// Mobile menu
	$('.mobile-menu-icon').click(function(){
		$('.tm-nav').toggleClass('show');
	});
  
  	 
  	$('body').bind('touchstart', function() {});
});

function scrollContent() {
    try {
        const container = document.getElementById("content1");
        const widthItem = document.querySelectorAll('.brand-ex')?.offsetWidth;
        
        if (!container || !widthItem) {
            console.warn('Required elements not found');
            return;
        }
        
        requestAnimationFrame(() => {
            container.scrollLeft += widthItem;
        });
    } catch (error) {
        console.error('Scrolling error:', error);
    }
}

 
 

