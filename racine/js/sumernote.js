(function($){
    "use strict";
    var POTENZA = {};
  
    /*************************
    Predefined Variables
  *************************/ 
  var $window = $(window),
      $document = $(document);
      //Check if function exists
      $.fn.exists = function () {
          return this.length > 0;
      };

  /*************************
      Summernote
  *************************/ 
  
  POTENZA.summernoteeditor = function () { 
   if ($('#summernote').exists()) {
          $('#summernote').summernote({
          height: 250,                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          focus: false                  // set focus to editable area after initializing summernote
        });
       }
     }
  
  /****************************************************
            javascript
  ****************************************************/
  var _arr  = {};
    function loadScript(scriptName, callback) {
      if (!_arr[scriptName]) {
        _arr[scriptName] = true;
        var body    = document.getElementsByTagName('body')[0];
        var script    = document.createElement('script');
        script.type   = 'text/javascript';
        script.src    = scriptName;
          script.onload = callback;
        // fire the loading
        body.appendChild(script);
      } else if (callback) {
        callback();
      }
    };
  
  /****************************************************
       POTENZA Window load and functions
  ****************************************************/
    //Window load functions
      $window.on("load",function(){
            POTENZA.preloader()
      });
   //Document ready functions
      $document.ready(function () {
          POTENZA.summernoteeditor();
      });
  })(jQuery);