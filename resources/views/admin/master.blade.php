<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/datepicker3.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightgray/content.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightgray/skin.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/fileinput.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/froala_editor.css')}}">
    <link rel="stylesheet" href="{{asset('css/froala_style.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/code_view.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/image.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/colors.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
     <link rel="stylesheet" href="{{asset('css/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/codemirror.min.css')}}">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/jscolor.min.js')}}"></script>
    <script src="{{asset('js/lumino.glyphs.js')}}"></script>
    <script src="{{asset('js/fileinput.js')}}"></script>
     <script src="{{asset('js/jquery.validate.js')}}"></script>
    <script src="{{asset('js/tinymce.min.js')}}"></script>
   {{-- <script>tinymce.init({ selector:'textarea' });</script> --}}

</head>
<body>
    @yield('content')
    
    <script src="{{asset('bootstrap/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/chart.min.js')}}"></script>
{{-- 	<script src="{{asset('js/chart-data.js')}}"></script>
	<script src="{{asset('js/easypiechart-data.js')}}"></script> --}}
	<script src="{{asset('js/bootstrap-datepicker.js')}}"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
                         function updatePermission(id){
                           var permission=$("#user"+id).text();
                           var userid=$("#user"+id).data('value');
                           jQuery.ajax({
                            url:"{{route('updatePermission')}}",
                            type:'get',
                            data:{permission:permission,userid:userid},
                            success:function(data){
                            }
                           });
                      }



                   $(function(){
                        $('#edit').froalaEditor({
                          toolbarButtons: ['bold', 'italic', 'underline', 'strikeThrough', 'color', '|', 'paragraphFormat', 'align', 'undo', 'redo', 'html'],
                          // Colors list.
                          colorsBackground: [
                            '#15E67F', '#E3DE8C', '#D8A076', '#D83762', '#76B6D8', 'REMOVE',
                            '#1C7A90', '#249CB8', '#4ABED9', '#FBD75B', '#FBE571', '#FFFFFF'
                          ],
                          colorsDefaultTab: 'background',
                          colorsStep: 6,
                          colorsText: [
                            '#15E67F', '#E3DE8C', '#D8A076', '#D83762', '#76B6D8', 'REMOVE',
                            '#1C7A90', '#249CB8', '#4ABED9', '#FBD75B', '#FBE571', '#FFFFFF'
                          ]
                        })
                      });
                      function updateAction(id,action){
                          jQuery.ajax({
                            url:'{{route('updateAction')}}',
                            type:'get',
                            data:{id:id,action:action},
                            success:function(data){
                             window.location.reload();
                            }
                          });
                      }
                      function editCat(id,name,description,image){
                        $("#id").val(id);
                        $("#category").val(name);
                        $("#img").attr("src","{{asset('uploads')}}/"+image);
                        tinyMCE.activeEditor.dom.setHTML(tinyMCE.activeEditor.dom.select('p'), description);
                        $("#myModalCategory").modal();
                      }

                      function updateCat(id){
                        var con=confirm("Do you want to delete this item?");
                        if(con==true){
                          jQuery.ajax({
                          url:"{{route('ajaxUpdateCat')}}",
                          type:"get",
                          data:{id:id},
                          success:function(data){
                            window.location.reload();
                          }
                        });
                        }
                      }

                      function modalFood(){
                        $(".modal").modal();
                        return false;
                      }

                      function editLocation(id,address,description){
                        $("#id_location").val(id);
                        $("#address_location").val(address);
                        // $("#description_location").val(description);
                        tinyMCE.activeEditor.dom.setHTML(tinyMCE.activeEditor.dom.select('p'), description);

                        $(".modalLocation").modal();
                      }

                      function deleteLocation(id){
                          var con=confirm("Do you want to delete this item?");
                          if(con==true){
                            jQuery.ajax({
                            url:"{{route('deleteLocation')}}",
                            type:"get",
                            data:{id:id},
                            success:function(data){
                              console.log(data);
                              window.location.reload();
                            }
                          });
                          }
                      }

                      function editRegion(id,name,description){
                       $("#region_id").val(id);
                       $("#region_name").val(name);
                       // $("#description_region").val(description);
                       tinyMCE.activeEditor.dom.setHTML(tinyMCE.activeEditor.dom.select('p'), description);
                        $(".modalRegion").modal();
                      }

                      function deleteRegion(id){
                         var con=confirm("Do you want to delete this item?");
                          if(con==true){
                            jQuery.ajax({
                            url:"{{route('deleteRegion')}}",
                            type:"get",
                            data:{id:id},
                            success:function(data){
                              console.log(data);
                              window.location.reload();
                            }
                          });
                          }
                      }

                      function editStoreType(id,name,description){
                        $("#idtype").val(id);
                        $("#nametype").val(name);
                         $("#edit p").html(description);
                        $(".modal").modal();
                      }

                      function deleteType(id){
                          var con=confirm("Do you want to delete this item?");
                          if(con==true){
                            jQuery.ajax({
                            url:"{{route('deleteType')}}",
                            type:"get",
                            data:{id:id},
                            success:function(data){
                              console.log(data);
                              window.location.reload();
                            }
                          });
                          }
                      }
                      $('#file-5').fileinput({
                        showUpload: false,
                      });

                      function changePermission(permission){
                        jQuery.ajax({
                          url:"{{route('permission')}}",
                          type:"GET",
                          data:{lavel:permission},
                          success:function(data){
                            window.location.reload();
                          }
                        });
                      }
                      function deleteImage(id,index,image){
                        jQuery.ajax({
                          url:"{{route('deleteimage')}}",
                          type:"GET",
                          data:{id:id,index:index,image:image},
                          success:function(data){
                           window.location.reload();
                          }
                        });
                        return false;
                      }


	</script>
         <script src="{{asset('js/app.js')}}"></script>
  
        <script type="text/javascript" src="{{asset('js/codemirror.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/xml.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/froala_editor.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/code_beautifier.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/code_beautifier.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/code_view.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/draggable.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/font_size.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/font_family.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/paragraph_style.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/lists.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/image.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/link.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/video.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/colors.min.js')}}"></script>

</body>
</html>