/////////////////////////////////////////////////////////////////////
// COMMON WEB FUNCTIONS                                            //
//                                                                 //
// Developed by Sean Gallagher of Gallagher Website Design         //
// Web: www.GallagherWebsiteDesign.com                             //
// Email: sean@gallagherwebsitedesign.com                          //
//                                                                 //
// Unauthorized use of this script in full or in part may result   //
// in legal action. Only those with written permission have legal  //
// right of use of the code, in full or in part, contained in this //
// document and it's related files.                                //
//                                                                 //
// Copyright 2013. Gallagher Website Design. All Rights Reserved.  //
/////////////////////////////////////////////////////////////////////

//////////////////
// INPUT STYLE //
/////////////////
function inputStyle()
{
 var browserVer = $.browser.version.replace(/[^\d.-]/g,'')*1;
 $('input:text').each(function()
 {
  if(!$(this).hasClass('input'))
  {
   $(this).addClass('input');
   if($.browser.msie && browserVer<=8) { $(this).wrap('<span class="input"> </span>'); }
   else { $(this).wrap('<span class="input">'); }
  }
 });
 $('input:checkbox').each(function()
 {
  if(!$(this).hasClass('checkbox'))
  {
   $(this).addClass('checkbox');
  }
 });
 $('input:submit,input:button,button').each(function()
 {
  if(!$(this).hasClass('button') && !$(this).hasClass('normalinput') )
  {
   var red_button = ($(this).hasClass('button_red')) ? ' button_red' : '';
   $(this).addClass('button');
   if($.browser.msie && browserVer<=8) { $(this).wrap('<div class="button'+red_button+'"> </div>'); }
   else { $(this).wrap('<div class="button'+red_button+'">'); }
  }
 });
 $('a.button').each(function()
 {
  if(!$(this).parent().hasClass('button'))
  {
   var red_button = ($(this).hasClass('button_red')) ? ' button_red' : '';
   $(this).addClass('button');
   if($.browser.msie && browserVer<=8) { $(this).wrap('<div class="button'+red_button+'"> </div>'); }
   else { $(this).wrap('<div class="button'+red_button+'">'); }
  }
 });
 if(!($.browser.msie && browserVer<=9)) { $('select').selectbox(); }
}

//////////////
// SLIDERS //
/////////////
function sliderVals()
{
 $('.frm_slider').bind('slider:changed', function (event, data)
 {
  var id = $(this).attr('id');
  //var val = Math.floor(data.value * 10);
  //$('#'+id+'_value').val(val);
  if(!$('#'+id+'_value').is(':focus')) { $('#'+id+'_value').val(data.value+'+'); }
 });
 $('.frm_slider_value').bind('change keyup input',function()
 {
  //$(this).val($(this).val().replace(/[^0-9\.]/g,"")+'+');
  var id = $(this).attr('id').replace('_value','');
  var val = $(this).val().replace(/[^0-9\.]/g,"");
  $('#'+id).simpleSlider("setValue",val);
 });
 $('.frm_slider_value').bind('focusout',function()
 {
  $(this).val($(this).val().replace(/[^0-9\.]/g,"")+'+');
 });
 $('.frm_slider_value').each(function()
 {
  $(this).val($(this).val().replace(/[^0-9\.]/g,"")+'+');
  var id = $(this).attr('id').replace('_value','');
  var val = $(this).val().replace(/[^0-9\.]/g,"");
  $('#'+id).simpleSlider("setValue",val);
 });
}

////////////////////////////////////
// FIX JQUERY SELECT BOX Z-INDEX //
///////////////////////////////////
function fixSelectBoxZindex()
{
 var zIndexNumber = 1000;
 $(".sbHolder").each(function()
 {
  $(this).css('zIndex',zIndexNumber);
  zIndexNumber -= 10;
 });
}

///////////////
// LOAD CSS //
//////////////
function loadCSS()
{
 if(navigator.userAgent.toLowerCase().indexOf('firefox/3')!=-1)
 {
   $("<link/>", {
    rel: "stylesheet",
    type: "text/css",
    href: "/css/ff3.css"
   }).appendTo("head");
 }
 if(navigator.userAgent.toLowerCase().indexOf('android')!=-1)
 {
   $("<link/>", {
    rel: "stylesheet",
    type: "text/css",
    href: "/css/android.css"
   }).appendTo("head");
 }
}

////////////////////
// WINDOW ONLOAD //
///////////////////
$(document).ready(function()
{
 inputStyle();
 sliderVals();
 fixSelectBoxZindex();
 loadCSS();
});
