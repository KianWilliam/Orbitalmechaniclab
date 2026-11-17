<?php 
/*
  * @package component kwpsolarsystem for Joomla! 5.x 6.x
 * @version $Id: kwpsolarsystem 1.0.0 2026-05-05 01:10:10Z $
 * @author KWProductions Co.
 * @copyright (C) 2022- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of kwpsolarsystem.
    kwpsolarsystem is free software: you can redistribute it and/or adify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    kwpsolarsystem is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for are details.
    You should have received a copy of the GNU General Public License
    along with kwpsolarsystem.  If not, see <http://www.gnu.org/licenses/>.
 
*/

?>
<?php

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
HTMLHelper::_('jquery.framework');

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();

$params=json_decode($this->item->params);
$gforce = (float)  $params->gforce;
//exit();
$sleft = $params->solar_left;
$stop = $params->solar_top;
//var_dump($sleft);
//var_dump($stop);
$svgw = $params->solar_width;
$svgh = $params->solar_height;
$a1 = $params->semi_majoraxis;
$which = $params->ellipseorpath;

$earthradius = 6371000;
$a1 += 6371000;
$a = $a1/50000;
//var_dump($a);
//exit();
$e = $params->ecc;
$mass = $params->central_mass;
$a = (int) $a;
$e = (float) $e;
$sleft = (int) $sleft;
$stop = (int) $stop;
//$a = 200;
//$e = 0.9;
$c = ($a * $e);
$focusleft = $sleft - $c;
$focustop = $stop;
$imageheight=46;
$imagewidth=46;
//$c = $c;
//var_dump($sleft);
//var_dump($focusleft);
//var_dump($focustop);
$B = pow($a, 2) - pow($c, 2);

$b = (int)pow($B, 0.5);
//var_dump($b);
//exit();
$xs = [4];
$y=[4];
$xs[0]=200;
$xs[1]=200-(200/10);
$xs[2]=200-(400/10);
$xs[3]=200-(600/10);
for($i=0; $i<4; $i++)
$y[$i]=sqrt((1-pow(($xs[$i]/$a), 2))*pow($b, 2));

for($i=0; $i<4; $i++)
{
	$xs[$i]=$xs[$i]+250;
	$y[$i]=$y[$i]+250;
}

$doubleperiod = (4 * pow(M_PI, 2) * pow($a1, 3) )/ ($mass * $gforce);
$T = sqrt($doubleperiod);
$orbitalspeed = sqrt(($gforce * $mass)/$a1);
//var_dump($T);
//var_dump($orbitalspeed);
//exit();
$perihelion = 50000 * ($a-$c);
$aphilion = 50000 * ($a + $c);
$angularvelocity = (2 * M_PI)/$T;








?>
<style type="text/css">
.orbitalmechaniclab{
	background-color:#000;
	display:grid;
	
}
#infob, #info
{
	border-radius:45%;
	color:#000;
	background-color:#f0f8ff;
	border:1px solid #000;
	display:none;
	width:400px; 
	height:100px;
	text-align:center;
	padding-top:12px;
}
#focus
{
	width:100px;
}
.satelite
{
	display:none;
}
</style>


<?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1>
			<?php if ($this->escape($this->params->get('page_heading'))) : ?>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			<?php else : ?>
				<?php echo $this->escape($this->params->get('page_title')); ?>
			<?php endif; ?>
        </h1>
    </div>
<?php endif; ?>


       
	<div class="orbitalmechaniclab" >
	
	<div style="color:#fff;text-align:left;width:40%; padding: 5px; background-size:100% 100%;background-image:url(<?php uri::base(); ?>administrator/components/com_orbitalmechaniclab/assets/images/m31.png);color:#fff;";>
	     <div>Perihelion:<?php echo $perihelion/1000; ?> km</div>
		 <div>Aphilion: <?php echo $aphilion/1000; ?> km</div>
	     <div>Orbital Velocity:<?php echo $angularvelocity; ?></div>

	</div>
	
	<?php if($which==0){ ?>	
  	<img class="satelite" src="<?php echo uri::base(); ?>administrator/components/com_orbitalmechaniclab/assets/images/sat1.jpg" width="93px" height="35px"/>
      
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500">
  <ellipse id="haha" class="orbit" cx="<?php echo $sleft; ?>" cy="<?php echo $stop; ?>" rx="0" ry="0" fill="none"  stroke="blue" stroke-width="15"/>
    Sorry, your browser does not support inline SVG.

     <div id="focus" style="margin-left:<?php echo $focusleft-$imagewidth; ?>px; margin-top:<?php echo $focustop-500-$imageheight; ?>px; display:none; font-size:2em" ><img src="<?php uri::base() ?>/administrator/components/com_orbitalmechaniclab/assets/images/earth.jpg" ></div>
     <div id="infob" style=""></div>

</svg>

  
	<?php } else { ?>
  
<svg width="500" height="500" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" >
    <!--  <g id="SvgjsG1120" transform="matrix(01,0,0,1,0,0)"> -->
   
		<path id="path"   class="pathorbit1"  d="" stroke="blue" fill="none" stroke-width="15" ></path>
		<path id="pathb"  class="pathorbit2" d="" stroke="blue" fill="none" stroke-width="15" ></path>
		<path id="pathc"  class="pathorbit3" d="" stroke="blue" fill="none" stroke-width="15" ></path>
		<path id="pathd"  class="pathorbit4" d="" stroke="blue" fill="none" stroke-width="15" ></path>
     <div id="focus" style="margin-left:<?php echo $focusleft-$imagewidth; ?>px; margin-top:<?php echo $focustop-500-$imageheight; ?>px; display:none; font-size:2em" ><img src="<?php uri::base() ?>/administrator/components/com_orbitalmechaniclab/assets/images/earth.jpg" ></div>

     <div id="info"></div>


		<!-- </g> -->
    
</svg>
	<?php } ?>


		
	</div>	
<script type="text/javascript">

(function(){
	
	var which;
    which = <?php echo $which; ?>;



	
    window.el = document.getElementById("path");
	    window.elb = document.getElementById("pathb");
			    window.elc = document.getElementById("pathc");
							    window.eld = document.getElementById("pathd");
								
								
								
								
								
								
								

const a =<?php echo $a; ?>;
const b =<?php echo $b; ?>;


	
	 const x0 = <?php echo $sleft - $a; ?>;
	const y1 = <?php echo $stop  ?>;


    var x1= <?php echo $sleft - $a; ?>;
    var y0=<?php echo $stop; ?>;

	
//	 var x2=<?php echo $sleft+$a; ?>;
	 	 var x2=<?php echo $sleft; ?>;

	var y11=<?php echo $stop - $b; ?>;

	
	// var x111=<?php echo $sleft+$a+$a; ?>;
	 	 var x111=<?php echo $sleft+$a; ?>;

	var y111=<?php echo $stop; ?>;

	
	// var x1111=<?php echo $sleft+$a; ?>;
	 	 var x1111=<?php echo $sleft; ?>;

	var y1111=<?php echo $stop+$b; ?>;
	
    const y2 = 300;
	var intervala;
	var intervalb;
	var intervalc;
	var intervald;


	
	var x0b = 500;
	var y0b = 100;

    var top = `${x1} ${y0}`;
    const middle = `${x1} ${y1}`;
   
    var bottom = `${x111} ${y111}`;
    var left = `${x0} ${y1}`;
	var right = `${x2} ${y11}`;
	


	var d;
	function inita()
	{
		//if(y0>100)
		if(y0>(y1-b))
			y0--;
		if(x1<(x0+a))
			x1++;
		else
		{
			clearInterval(intervala);
			initb();
		}
		    top = `${x1} ${y0}`;

		
		   d = `M ${left} ` +
              `C ${left} ${x0} ${y0}  ${top} `;
			                

			                
    window.el.setAttribute('d', d);
	intervala= setInterval(function(){
		inita();
	}, 90);
	
	}
	
	
	function initb()
	{
		//if(y11<200)
		if(y11<y1)
			y11++;
		if(x2<(x0+a+a))
			x2++;
		else
		{
			clearInterval(intervalb);
			initc();
		}
		    right = `${x2} ${y11}`;

		
		  d2 = `M ${top} ` +
			     `C ${top} ${x2} ${y0} ${right} `;
						

			                

			                
    window.elb.setAttribute('d', d2);
	intervalb= setInterval(function(){
		initb();
	}, 90);
	}
	
	function initc()
	{
		//console.log("boro...");
		if(y111<(y1+b))
			y111++;
		if(x111>x0+a)
			x111--;
		else
		{
			clearInterval(intervalc);
			initd();
		}
		    bottom = `${x111} ${y111}`;

		
		  d3 = `M ${right} ` +
			     `C ${right} ${x2} ${y111} ${bottom} `;
						

			                

			                
    window.elc.setAttribute('d', d3);
	intervalc= setInterval(function(){
		initc();
	}, 90);
	}
	
	function initd()
	{
		if(y1111>y1)
			y1111--;
		if(x1111>x0)
			x1111--;
		else
		{
			clearInterval(intervald);
						jQuery("#focus").css("display", "block");

		}
		    left = `${x1111} ${y1111}`;

		
		  d4 = `M ${bottom} ` +
			     `C ${bottom} ${x1111} ${y111} ${left} `;
						

			                

			                
    window.eld.setAttribute('d', d4);
	intervald= setInterval(function(){
		initd();
	}, 90);
	}
	if(which==1)
	inita();
})();


jQuery(document).ready(function(){
	
	

 var a;
 var b;

var c;
var fleft;
var ftop;
var ecc;
var angularvelocity;
var tangentialvelocity;
var orbitalperiod;
var peri;
var aphi;


var le;
					var to;
					var X;
					var Y;
					var t;
					var base;
					var height;
					var tang;
					var radius;
					var denom;

    
    which = <?php echo $which; ?>;





 
	
	  let isP1;
					  const svg = document.getElementsByTagName("svg")[0];
					  const path1 = document.getElementById("path");
					  const path2 = document.getElementById("pathb");
					  const path3 = document.getElementById("pathc");
					  const path4 = document.getElementById("pathd");
					  						var t;

					  
		function pathsevents()
		{
			
			
 a= "<?php echo $a; ?>";
 b= "<?php echo $b; ?>";
 c = "<?php echo $c; ?>";
 fleft= "<?php echo $focusleft; ?>";
  ecc = "<?php echo $e; ?>";
  angularvelocity =   "<?php echo $angularvelocity; ?>";
   orbitalperiod = "<?php echo $T; ?>";
    peri = "<?php echo $perihelion; ?>";
	 aphi = "<?php echo $aphilion; ?>";
	  ftop= "<?php echo $focustop; ?>";

			
			
					jQuery(".pathorbit1").on("mousemove mouseover", function(event){   
					var le;
					var to;
					var X;
					var Y;
					le = jQuery(".pathorbit1").position().left;
					to = jQuery(".pathorbit1").position().top;
					X = event.offsetX ;
					Y = event.offsetY ;
					console.log("left:"+fleft);
			console.log("top:"+ftop);
					//rx = (X-fleft)*50000;
					//ry = (Y-ftop)*50000;
					//rad = Math.pow(rx, 2)+Math.pow(ry, 2)
					//console.log(X+'-'+Y);
						//console.log("rx:"+rx);
			//console.log("ry:"+ry);
					//radius =  Math.sqrt(rad);
										radius = Math.sqrt(Math.pow(Math.abs(X - fleft)*50000, 2)+Math.pow(Math.abs(Y - ftop)*50000, 2));

					console.log('radius'+radius)

				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = (height / base);
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					 centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));
					


					

  try {
    const pointObjb = { x: X, y: Y };
    isP1 = path1.isPointInStroke(pointObjb);

	
	 if(isP1){
					
												t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						


	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;
	
	 isP1 = path1.isPointInStroke(pointObjb);

	
	 if(isP1){
						t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

						
						

	 }
             }

      
					});
					
										jQuery(".pathorbit1").on("mouseout", function(e){ 
															jQuery("#info").css({display:'none'});

                                        });										

					
			//////		
						jQuery(".pathorbit2").on("mousemove mouseover", function(e){   
					
					
					var le;
					var to;
					var X;
					var Y;
					le = jQuery(".pathorbit1").position().left;
					to = jQuery(".pathorbit1").position().top;
					X = e.offsetX ;
					Y = e.offsetY ;
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*50000, 2)+Math.pow((Y - ftop)*50000, 2)));
				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					 centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));
					

					


					

  try {
    const pointObjb = { x: X, y: Y };
  
	isP1 = path2.isPointInStroke(pointObjb);
  

	
	 if(isP1){
							t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						


	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;
	
	isP1 = path2.isPointInStroke(pointObjb);
  
	
	 if(isP1){
							t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

						
	 }
                           }

      
					});
					
						jQuery(".pathorbit2").on("mouseout", function(e){ 
															jQuery("#info").css({display:'none'});

                                        });	
					
					/////////////////////////////
					
						jQuery(".pathorbit3").on("mousemove mouseover", function(e){   
					
					
					
					
					var le;
					var to;
					var X;
					var Y;
					le = jQuery(".pathorbit1").position().left;
					to = jQuery(".pathorbit1").position().top;
					X = e.offsetX ;
					Y = e.offsetY ;
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*50000, 2)+Math.pow((Y - ftop)*50000, 2)));
				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					 centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));
					

					
					


					

  try {
    const pointObjb = { x: X, y: Y };
 
    isP1 = path3.isPointInStroke(pointObjb);

	
	 if(isP1){
						t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						


	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;

   isP1 = path3.isPointInStroke(pointObjb);
	
	 if(isP1){
						t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
	
						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

	 }
           }

      
					});
					
						jQuery(".pathorbit3").on("mouseout", function(e){ 
															jQuery("#info").css({display:'none'});

                                        });	
					//////////////////////////
					
					
			jQuery(".pathorbit4").on("mousemove mouseover", function(e){ 

    
					
					
					var le;
					var to;
					var X;
					var Y;
					le = jQuery(".pathorbit1").position().left;
					to = jQuery(".pathorbit1").position().top;
					X = e.offsetX ;
					Y = e.offsetY ;
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*50000, 2)+Math.pow((Y - ftop)*50000, 2)));
				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					 centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));	
					
					


					

  try {
    const pointObjb = { x: X, y: Y };
    
   isP1 = path4.isPointInStroke(pointObjb);

	
	 if(isP1){
						t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;
 
    isP1 = path4.isPointInStroke(pointObjb);
	
	 if(isP1){
						t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

	 }
           }

      
					});
					
						jQuery(".pathorbit4").on("mouseout", function(e){ 
															jQuery("#info").css({display:'none'});

                                        });	
					
			
		}			
					  
				if(which==1)	  
					  pathsevents();


 });
 



jQuery(document).ready(function(){


                      let isP;
					  const svg = document.getElementsByTagName("svg")[0];
					  const ellipse = document.getElementById("haha");
					  
					  lw = jQuery(window).width();
					  lh =  jQuery(window).height();



var semi;
var secondsemi;
var interval;
semi=0;
secondsemi=0;
var a;
var b;
var c;
var fleft;
var ftop;
var ecc;
var angularvelocity;
var tangentialvelocity;
var orbitalperiod;
var peri;
var aphi;
var s;

 a= "<?php echo $a; ?>";
 b= "<?php echo $b; ?>";
 c = "<?php echo $c; ?>";
 fleft= "<?php echo $focusleft; ?>";
  ecc = "<?php echo $e; ?>";
  angularvelocity =   "<?php echo $angularvelocity; ?>";
   orbitalperiod = "<?php echo $T; ?>";
    peri = "<?php echo $perihelion; ?>";
	 aphi = "<?php echo $aphilion; ?>";


					//  console.log("haha:"+orbitalperiod);

    



 ftop= "<?php echo $focustop; ?>";
 s = ftop - b ;

    which = <?php echo $which; ?>;

 

 

	function init(){
		
		
					jQuery(".orbit").on("mousemove mouseover", function(e){   
					//e.clientX may not be compatible with pointstroke scale, check and change it in case.
					var le;
					var to;
					var X;
					var Y;
					var t;
					var base;
					var height;
					var tang;
					var radius;
					var denom;
					le = jQuery(".orbit").position().left;
					to = jQuery(".orbit").position().top;
					X = e.offsetX ;
					Y = e.offsetY ;
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*50000, 2)+Math.pow((Y - ftop)*50000, 2)));
				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					 centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));

					

  try {
    const pointObj = { x: X, y: Y };
    isP = ellipse.isPointInStroke(pointObj);
	
	 if(isP){
						console.log(e.offsetX);
						console.log(e.offsetY);
											t1 = pointObj.y - 500 - 20;			
						//jQuery("#infob").css({marginLeft:pointObj.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery("#infob").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});

						jQuery('#infob').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
											
											
											

	 }
	
  } catch {
    // Fallback for browsers that don't support DOMPoint as an argument
    const pointObj = svg.createSVGPoint();
    pointObj.x = X;
    pointObj.y = Y;
    isP = ellipse.isPointInStroke(pointObj);
	
	 if(isP){
						console.log(pointObj.x);
											console.log(pointObj.y);
											
											t1 = pointObj.y - 500 - 20;			
						jQuery("#infob").css({marginLeft:pointObj.x+'px', marginTop: t1 + 'px', display:'block'});
						jQuery('#infob').html(pointObj.x +'-'+pointObj.y);
	 }
  }

      
					});
					
					jQuery(".orbit").on("mouseout", function(e){ 
															jQuery("#infob").css({display:'none'});

                                        });	

		
		
	interval = setInterval(function(){
		
		if(semi<a )
			semi++;
		if(secondsemi<b)
			secondsemi++
		else
		{
			clearInterval(interval);
			jQuery("#focus").css("display", "block");
						jQuery(".satelite").css({ display:"block", position:"relative", left:fleft+'px', top:s+'px'});

		}

			jQuery(".orbit").attr("ry", semi);
						jQuery(".orbit").attr("rx", secondsemi);


		
	}, 1);
	
	}
if(which == 0)	
	init();
	
	
});
</script>	
		
    




