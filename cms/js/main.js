$(document).ready(function() {  
  //Menu link Click
  $().updateAllLinks();
});

function insertImage() {
var newElement = CKEDITOR.dom.element.createFromHtml( '<a href="http://kw.ya.id.lv/uploads/1010117b421cad32116cedfbc16724f6_0_500_0.jpg"><img src="http://kw.ya.id.lv/uploads/.thumbs/1010117b421cad32116cedfbc16724f6_0_500_0.jpg" /></a>', editor.document );
editor.insertElement( newElement );
}
