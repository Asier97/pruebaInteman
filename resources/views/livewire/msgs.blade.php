<div>
    <!-- El mensaje que se mostrará para dar información al usuario -->
    <div id="notificacion">
        <div id="detalle" style='background-color: {{$color}}'></div>
        <div id="msgs">
            <h4>{{$msg}}</h4>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            
            // Detectamos cuando el componente ha preparado un mensaje para mostrar y ocultarlo
            window.livewire.on('msgs:fades',()=>{
                $("#notificacion").fadeIn('fast');

                setTimeout(
                    function(){ $("#notificacion").fadeOut();
                }, 3000);
            });
        });
    </script>
<div
