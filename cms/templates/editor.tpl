<script src='/cms/js/editors.js'></script>

<ul class='nav nav-tabs'>
  <li class='active'><a href='#PageContent' data-toggle="tab">Page Content</a></li>  
  <li><a href='#HeaderImages' data-toggle="tab">Header Images</a></li>
  {extraTabs}
  <li class='pull-right'><a>Editing: <strong>{section}</strong> -> <strong>{pageTitle}</strong></a></li>  
</ul>
<div class='tab-content'>
  <div id='PageContent' class='tab-pane active'>
  <form method='post' class='aSync' action='{action}'>
    <table>
      <tr>
        <td colspan="2"><input type='hidden' value='1' name='saveContent' /><textarea name='pageContent' id='editfield'>{pageContent}</textarea></td>
      </tr>
      <tr>
        <td style='text-align:center;'><a class='submit btn btn-success'>Save</a></td>
      </tr>
    </table>
  </form>
  </div>
  <div id='HeaderImages' class='tab-pane'>
    <script src='/cms/js/fileUploader.js'></script>
    <div style='float:left;'>Image {comment}</div>
    <div style='float:right;'>Options <form method='post' id='uploadHeader' action='{action}'><input type='file' /></form></div>
    <div style='clear:both' class='clear'></div>
    {imageContent}
  </div>
  {extraTabContent}
</div>