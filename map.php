<?php 
	require_once("./include/util_config.php");
	if(isset($_POST['logout']))
	{
		$fixmycity->LogOut();
		$fixmycity->RedirectToURL("login.php");
	}
	
?>
<!doctype html>
<html>
	<?php include 'template/head.php';?>
	<body>
		<?php include 'template/header.php';?>
		
		<div class="map">
			<div id="map" class="fill-height"></div>
			<div id="popup" class="ol-popup">
				<a href="#" id="popup-closer" class="ol-popup-closer"></a>
				<div id="popup-content"></div>
			</div>
		</div>
		
		<?php include 'template/footer.php';?>
		
		<script type="text/javascript">
			jQuery(document).ready(function($){
				$("a.attiva-nav").click(function() {
					$("nav").slideToggle();
					$(this).toggleClass("active");
				});
				
				$(window).resize(function() {
					var windowsize = $(window).width();
					if (windowsize > 600) {
						$('nav').css('display', '');
					}
				});
				
			}); 
			var container = document.getElementById('popup');
			var content = document.getElementById('popup-content');
			var closer = document.getElementById('popup-closer');
			
			var overlay = new ol.Overlay(({
				element: container,
				positioning: 'bottom-center',
				stopEvent: false,
				offset: [0, -50],
				autoPan: true,
				autoPanAnimation: {
					duration: 250
				}
			}));
			
				closer.onclick = function() {
					overlay.setPosition(undefined);
					closer.blur();
					return false;
				};
				
				var iconStyle = new ol.style.Style({
					image: new ol.style.Icon({
						anchor: [0.5, 46],
						anchorXUnits: 'fraction',
						anchorYUnits: 'pixels',
						opacity: 0.75,
						src: 'img/pin.png'
					})
				});
				
				var vectorSource = new ol.source.Vector();
				var vectorLayer = new ol.layer.Vector({
					source: vectorSource
				});		
				
				map = new ol.Map({
					interactions : ol.interaction.defaults({doubleClickZoom :false}),
					target: document.getElementById('map'),
					view: new ol.View({
						center: [998727.43,5527988.53],
						zoom: 17,
						minZoom: 15,
						maxZoom: 19
					}),
					overlays: [overlay],
					layers: [new ol.layer.Tile({source: new ol.source.OSM()}), vectorLayer]
				});			
				
				map.on('dblclick', function(evt){
					var feature = new ol.Feature({
						geometry: new ol.geom.Point(evt.coordinate),
						name: 'Null Island',
						population: 4000,
						rainfall: 500
					});
					feature.setStyle(iconStyle);
					vectorSource.addFeature(feature);
				});	
				
				map.on('click', function(evt) {
					var feature = map.forEachFeatureAtPixel(evt.pixel,
					function(feature) {
						return feature;
					});
					if (feature) {
						var coordinates = feature.getGeometry().getCoordinates();
						overlay.setPosition(coordinates);
						content.innerHTML = feature.get('name');
					}
				});
				
				map.on('pointermove', function(e) {
					var pixel = map.getEventPixel(e.originalEvent);
					var hit = map.hasFeatureAtPixel(pixel);
					map.getTarget().style.cursor = hit ? 'pointer' : '';
				});		
			</script>
			
	</body>
</html>												