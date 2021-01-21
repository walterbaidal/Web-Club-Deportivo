<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['id'] ) ) {

?>

<!DOCTYPE html>
<html>
<head>
	<title>Menu Pandas F.C</title>
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
	<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  	<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>
  	<script src="js/locales/es.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/locales-all.min.js"></script>



  	<script>
   
	  	$(document).ready(function() {
		   	var calendar = $('#calendar').fullCalendar({
		   		locale: 'es',		
		   		plugins: [ 'dayGrid' ],
  				aspectRatio: 2.2,
  				fixedWeekCount: false,
			    
			    
			    header:{
					left:'prev,next today',
					center:'title',
					right:''
			    },
			    eventTextColor: 'white',
			    events: 'calendario/load_script.php',
			    selectable:true,
			    selectHelper:true,
			    droppable: true,
			    <?php if ( $_SESSION['tipo_usuario'] == 1 ) { ?>
			    	editable: true,
				    select: function(date, time, allDay)
				    {
				    	if (confirm("¿Deseas crear un nuevo evento?")){
							var title = prompt("Titulo");
							var type = prompt("Codigo evento" + "\n" + "1. Cena" + "\n" + "2. Fiesta" + "\n" + "3. Reunion" + "\n" + "4. Liga" + "\n" + "5. Copa" + "\n" + "6. Torneo");
							var time = prompt("Hora formato HH:mm:ss");
							if(title && type && time)	{ 
								var date = $.fullCalendar.formatDate(date, "YYYY-MM-DD");
								$.ajax({
									url:"calendario/insert_script.php",
									type:"POST",
									data:{title:title, date:date, time:time, type:type},
									success:function() {			
										calendar.fullCalendar('refetchEvents');
										alert("Evento añadido correctamente");
									}
								})
							}
						}
				    },
				    editable:true,
				    eventDrop: function(event) {
				    	if (confirm("¿Seguro que quieres editar este evento?")){
							var date = "";
							var title = prompt("Titulo", event.title);
							var type = prompt("Codigo evento" + "\n" + "1. Cena" + "\n" + "2. Fiesta" + "\n" + "3. Reunion" + "\n" + "4. Liga" + "\n" + "5. Copa" + "\n" + "6. Torneo", event.id_type);
							var time = prompt("Hora formato HH:mm:ss", event.time);
							var date = event._start._d.toISOString();
							var id = event.id;
			     
							$.ajax({
								url:"calendario/update_script.php",
								type:"POST",
								data:{id:id, title:title, date:date, time:time, type:type},
								success:function()	{
									calendar.fullCalendar('refetchEvents');
									alert("Evento actualizado");
								}
							});
						} else {
							calendar.fullCalendar('refetchEvents');
						}
					},
				    eventClick:function(event) {
						if(confirm("Descripción: " + event.title + "\n" + "Hora: " + event.time + "\n" + "Tipo evento: " + event.type + "\n\n Te gustaría borrar este evento?")) {
							
								if (confirm("¿Estás seguro que deseas borrar este evento?")){
								var id = event.id;
								$.ajax({
									url:"calendario/delete_script.php",
									type:"POST",
									data:{id:id},
									success:function() {
										calendar.fullCalendar('refetchEvents');
										alert("Event eliminado correctamente");
									}
								})
							}
						}
					},


				<?php } else { ?>

					eventClick:function(event) {
						alert("Descripción: " + event.title + "\n" + "Hora: " + event.time + "\n" + "Tipo evento: " + event.type);
					},
				<?php } ?>
				
	   		});
	   		console.log(calendar);
	  	});

	  	
  	</script>
</head>
<body>

	<style type="text/css">
		.navbar {
			padding: 0 !important;
		}

		.nav-item > a{
			margin: 0.4rem;
		}

		.container {
		    padding-top: 5%;

		}

		td.fc-today {
			background: #e9ceecf7 !important;
		}

		.fc-highlight {
			background: #49c8e2 !important;
		}
	</style>

		<div id="myBtn" title="Scroll para más" >Más info abajo</div>

	    <script>

	      var div = document.getElementById('myBtn');
	      if (div.scrollTop == 0) {
	        document.getElementById("myBtn").style.display = "block";
	      }

	      window.onscroll = function () { scrollFunction() };

	      function scrollFunction() {
	        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
	          document.getElementById("myBtn").style.display = "none";
	        } else {
	          document.getElementById("myBtn").style.display = "block";
	        }
	      }
	  	</script>

	<div class="container">
		<?php $opcion = 2 ?>
		<?php include 'navbar.php';?>

		<div class="mt-4 card">
			<div class="card-body">
				<div class="float-left">
			  		<h1 class="display-4">Calendario</h1>
				</div>
				<div class="float-right">
					<img class="img-fluid" src="CDI/CDI/3 - Menú principal - Jugador/Calendario.png" width="100px">
				</div>
			</div>
		</div>

		<div class="mt-4 card mb-4">
			<div class="container-fluid">

				<?php if ( $_SESSION['tipo_usuario'] == 1 ) { ?>

					<div class="d-flex bd-highlight mb-3">
					 	 <div class="p-2 bd-highlight"><h2>Selecciona un día para crear un nuevo evento</h2></div>
					  	<div class="ml-auto p-2 bd-highlight">
					  		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
						   		<i class="fa fa-question-circle"></i> Ayuda
							</button>
						</div>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLongTitle">Como usar el calendario.</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<div class="row">
					      		<div class="col-md-6"><b>Creacion: </b>Para crear <b>eventos</b>, pulsa sobre cualquier día del calendario y recibirás un alerta de si deseas crearlo.  </div>
					      		<div class="col-md-6"><img src="CDI/CDI/Guia/dias.png"  width="200" alt=""></div>
					      	</div>
					        	En caso de que no lo deseemos para ese día, se puede pulsar sobre <b>Cancelar</b>.
					       <br><hr>
							
					   
					        <b>Visualización y borrado: </b>Para ver la información de un evento, simplemente clickearemos sobre él, donde además tenemos la opción de borrar dicho evento si lo deseamos.
								<br><br>
					        <div class="text-center"><img src="CDI/CDI/Guia/info.png"  width="350" alt=""></div>
								<hr>
					        <div class="row">
					        	<div class="col-md-6"><b>Edición: </b>Si se desea cambiar un evento de día, simplemente lo arrastraremos al día deseado, donde además tendremos la opción de cambiar sus caracterísiticas</div>
					      		<div class="col-md-6"><img src="CDI/CDI/Guia/edit.png"  width="200" alt=""></div>
					      		
					      	</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-primary" data-dismiss="modal">De acuerdo</button>
					      </div>
					    </div>
					  </div>
					</div>
				<?php } ?>
				<div class="card-body">
					<div id="calendar"></div>
				</div>	
			</div>
		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.0/js/all.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php

} else {
    // Redirect them to the login page
    header("Location: index.php");
}

?>