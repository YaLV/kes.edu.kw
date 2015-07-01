<script src='/cms/js/editors.js'></script>
<ul class='nav nav-tabs'>
  <li class='active'><a href='#PageContent' data-toggle="tab">Page Content</a></li>  
  <li {dis} ><a href='#HeaderImages' data-toggle="tab">Header Images</a></li>
  <li class='pull-right'><a>Editing: <strong>{section}</strong> -> <strong>{pageTitle}</strong> {newsTitleArrow}</a></li>  
</ul>
<div class='tab-content'>
  <div id='PageContent' class='tab-pane active'>
    {currentContent}
  </div>
  <div id='HeaderImages' class='tab-pane'>
    <script src='/cms/js/fileUploader.js'></script>
    <div style='float:left;'>Image {comment}</div>
    <div style='float:right;'>Options <form method='post' id='uploadHeader' action='{action}'><input type='file' /></form></div>
    <div style='clear:both' class='clear'></div>
    {imageContent}
  </div>
</div>