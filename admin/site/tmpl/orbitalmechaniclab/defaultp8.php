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
$centermassimg = $params->sat;
$svgwidth = $params->solar_width;
$svgheight = $params->solar_height;
$scale = $params->scale; 
$cmradius = $params->cmradius; 
$cmwidth= $params->cmwidth; 
$cmheight = $params->cmheight; 
$infoleft = $params->infoleft; 
$infotop = $params->infotop; 




//var_dump($a1);

//$earthradius = 6371000;
$earthradius = $cmradius;
//$a1 += 6371000;
$a1 += $earthradius;
//$a = $a1/50000;
$a = $a1 / $scale;
//var_dump($a);
//var_dump($sleft);

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
//if($which==0)
$focusleft = $sleft - $c;
//else
//$focusleft = $sleft + $a - $c;
	
$focustop = $stop;

//$imageheight=46;
//$imagewidth=46;


$imageheight=$cmwidth/2;
$imagewidth=$cmheight/2;


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
//$perihelion = 50000 * ($a-$c);
//$aphilion = 50000 * ($a + $c);

$perihelion = $scale * ($a-$c);
$aphilion = $scale * ($a + $c);
//$angularvelocity = (2 * M_PI)/$T;
$angularvelocity = number_format(((2 * M_PI)/$T), 5);


//moving satellite codes

$x = array(17);
$y = array(17);
$rad = array(17);
$phi = 0;


	
				for($j=0; $j<=8; $j++)
				{						//var_dump(cos($phi));

					
					if($j==0)
					{
					//	$rad[$j]= (int) $perihelion/50000;
						$rad[$j]= (int) $perihelion/$scale;

						$rad[16]= $rad[0];
											//	var_dump($radius[$i][$j]);

					}
					else
						if($j==8)
						{
							//	$rad[$j]= (int) $aphilion/50000;
							    $rad[$j]= (int) $aphilion/$scale;

														//var_dump($radius[$i][$j]);

						}
						else
						if($j>0 && $j<8)
					    {
						$phi+=M_PI/8;
						
					//	if(cos($phi)<0)						
					//	$rad[$j] =  ($a*(1-pow($e, 2))) /  (1 +( $e * cos($phi) * (-1)) );
					//else
						$rad[$j] =  ($a *(1-pow($e, 2))) /  (1 +( $e * cos($phi) ) );


					    switch($j)
						{
							case 1:
							   $rad[15]=$rad[$j];
							  break;
							  case 2:
							   	$rad[14]=$rad[$j];
							  break;
							  case 3:
							   	$rad[13]=$rad[$j];
							  break;
							  case 4:
							      $rad[12]=$rad[$j];
							  break;
							  case 5:
							   $rad[11]=$rad[$j];
							  break;
							  case 6:
							   	$rad[10]=$rad[$j];
							  break;
							  case 7:
							   	$rad[9]=$rad[$j];
							  break;
							  
							  
						}
					}
										//var_dump(cos($phi));

				}
		//	var_dump($rad);
		//		exit();
			
			if($which==0){
			
			$heights = array(8);	
				$phi=0;
				for($j=0; $j<=8; $j++)
				{
						if(cos($phi)<0)
						{
								$x[$j]= $rad[$j] * cos($phi) * (-1);
								
						}
							else
							{
					              $x[$j]= $rad[$j] * cos($phi);
							}
								  if($phi < M_PI/2)
								  {
									//  $x[$j]= (($a - $c) - $x[$j])+$sleft-$a;
									  	$x[$j]= (($a - $c) - $x[$j])+$sleft-$a;

								  }
								 else 
								  if($phi > M_PI/2)
								  {
									   $x[$j]= (($a - $c) +$x[$j]) + $sleft - $a;
								  }
								   else
								   {
									   $x[$j]= $sleft - $c;
								   }


							//}
				                
								if($j<8)
								{
									$heights[$j]= 2 * $rad[$j] * sin($phi);
										$y[$j]= $stop - ($rad[$j] * sin($phi));
								}
									else
									$y[$j]=$stop;
										

					$phi+=M_PI/8;
				}
		//var_dump($x);
		//	var_dump($y);
		//		exit();
				
				for($j=0; $j<=8; $j++)
				{
					if($j==0)
					{
						
						$x[16]=$x[$j];
						$y[16]=$y[$j];
					}
					
						
						  switch($j)
						{
							case 1:
							   $x[15]=$x[$j] ;
							   $y[15]= $heights[1] + $y[$j];
							  break;
							  case 2:
							   	$x[14]=$x[$j] ;
							    $y[14]= $heights[2] + $y[$j];
							  break;
							  case 3:
							   	$x[13]=$x[$j] ;
								 $y[13]= $heights[3]  + $y[$j];
							  break;
							  case 4:
							      $x[12]=$x[$j] ;
								  $y[12]= $heights[4]  + $y[$j];
							  break;
							  case 5:
							   $x[11]=$x[$j] ;
							   $y[11]= $heights[5]  + $y[$j];
							  break;
							  case 6:
							   	$x[10]=$x[$j] ;
							    $y[10]= $heights[6] + $y[$j];
							  break;
							  case 7:
							   	$x[9]=$x[$j] ;
								 $y[9]= $heights[7]  + $y[$j];
							  break;
							  
							  
						}
						
						
				}
				
				
				
				for($j=0; $j<=16; $j++)
				{
					//$x[$j]=$x[$j]-(2*$a);
										$x[$j]=$x[$j]-$a/4;

					//$y[$j]=$y[$j]-$b/2;
					if($scale<=20000)
						$y[$j]=$y[$j]+(3 * $b)/9;
                    else
					if($scale>20000 && $scale<=25000)
					$y[$j]=$y[$j]+$b/2;
				    else
						if($scale>25000 && $scale<=30000)
					$y[$j]=$y[$j]+(4*$b/7);
				     else
						 if($scale>30000 && $scale<40000)
						 $y[$j]=$y[$j]+$b/2;
					 else
						 $y[$j]=$y[$j]+ (3 * $b)/4;



					

				}
				
				}
				else
				{
					$heights = array(8);	
				$phi=0;
				for($j=0; $j<=8; $j++)
				{
						if(cos($phi)<0)
						{
								$x[$j]= $rad[$j] * cos($phi) * (-1);
								
						}
							else
							{
					              $x[$j]= $rad[$j] * cos($phi);
							}
							
								  if($phi < M_PI/2)
									  $x[$j]= ($a - $c) -$x[$j]+$sleft;
								 else 
								  if($phi > M_PI/2)
									   $x[$j]= ($a - $c) +$x[$j] + $sleft;
								   else
									   $x[$j]= $sleft + $a - $c;


							//}
				                
								if($j<8)
								{
									$heights[$j]= 2 * $rad[$j] * sin($phi);
										$y[$j]= $stop - ($rad[$j] * sin($phi));
								}
									else
									$y[$j]=$stop;
										

					$phi+=M_PI/8;
				}
				
				//var_dump($x);
			//var_dump($y);
			//	exit();
				for($j=0; $j<=8; $j++)
				{
					if($j==0)
					{
						
						$x[16]=$x[$j];
						$y[16]=$y[$j];
					}
					
						
						  switch($j)
						{
							case 1:
							   $x[15]=$x[$j] ;
							   $y[15]= $heights[1] + $y[$j];
							  break;
							  case 2:
							   	$x[14]=$x[$j] ;
							    $y[14]= $heights[2] + $y[$j];
							  break;
							  case 3:
							   	$x[13]=$x[$j] ;
								 $y[13]= $heights[3]  + $y[$j];
							  break;
							  case 4:
							      $x[12]=$x[$j] ;
								  $y[12]= $heights[4]  + $y[$j];
							  break;
							  case 5:
							   $x[11]=$x[$j] ;
							   $y[11]= $heights[5]  + $y[$j];
							  break;
							  case 6:
							   	$x[10]=$x[$j] ;
							    $y[10]= $heights[6] + $y[$j];
							  break;
							  case 7:
							   	$x[9]=$x[$j] ;
								 $y[9]= $heights[7]  + $y[$j];
							  break;
							  
							  
						}
						
						
				}
				
				
				
				
				
				for($j=0; $j<=16; $j++)
				{
				$x[$j]=$x[$j]-(($a*5)/4);
								//$x[$j]=$x[$j]-($a);

							if($scale<=20000)
						$y[$j]=$y[$j]+(3 * $b)/9;
                    else
					if($scale>20000 && $scale<=25000)
					$y[$j]=$y[$j]+$b/2;
				    else
						if($scale>25000 && $scale<=30000)
					$y[$j]=$y[$j]+(4*$b/7);
				     else
						 if($scale>30000 && $scale<40000)
						 $y[$j]=$y[$j]+$b/2;
					 else
						 $y[$j]=$y[$j]+ (3 * $b)/4;			

					//$y[$j]=$y[$j]+$b/3;

				}
				
				
				
				}
				
			//	var_dump($x);
			//	var_dump($y);
			//	exit();
				
		
			
			$framepiece ="
			
			
                 @property --angle
                 {
	               syntax: '<angle>';
	               inherits: true;
	                initial-value:0deg;
                 }
              
                @property --bk
                {
                   syntax: '<string>';
                   inherits:false;
                    initial-value:'blue';
                }
			
				@property --xamp
                {
	               syntax: '<length>';
	               inherits: true;
	               initial-value:93px;
                }
				@property --yamp
                {
	               syntax: '<length>';
	               inherits: true;
	               initial-value:93px;
                }
			
				
				
               :root
                {
                     --bk:#000;
                 }
            
			
			   @keyframes revolve
               {
	                0%  {  --xamp:".$x[0]."px;    --yamp:".$y[0]."px;  --angle:0deg;    }
				    6.25%  {   --xamp:".$x[1]."px;    --yamp:".$y[1]."px;  --angle:22.5deg;    }
					12.5%  {   --xamp:".$x[2]."px;    --yamp:".$y[2]."px;   --angle:45deg;    }
				    18.75%  {   --xamp:".$x[3]."px;    --yamp:".$y[3]."px;    --angle:67.5deg;    }
					 25%  {   --xamp:".$x[4]."px;    --yamp:".$y[4]."px;    --angle:90deg;    }
				    31.25%  {   --xamp:".$x[5]."px;    --yamp:".$y[5]."px;    --angle:112.5deg;    }
					37.5%  {   --xamp:".$x[6]."px;    --yamp:".$y[6]."px;  --angle:135deg;    }
				    43.75%  {   --xamp:".$x[7]."px;    --yamp:".$y[7]."px;   --angle:157.5deg;   }
					 50%  {   --xamp:".$x[8]."px;    --yamp:".$y[8]."px;    --angle:180deg; }
				    56.25%  {   --xamp:".$x[9]."px;    --yamp:".$y[9]."px;    --angle:202.5deg;  }
					62.5%  {   --xamp:".$x[10]."px;    --yamp:".$y[10]."px;   --angle:225.5deg;}   
					68.75%  {   --xamp:".$x[11]."px;    --yamp:".$y[11]."px;   --angle:247.5deg;}             
					75%  {   --xamp:".$x[12]."px;    --yamp:".$y[12]."px;   --angle:270deg;} 
					81.25%  {   --xamp:".$x[13]."px;    --yamp:".$y[13]."px;   --angle:292.5deg;}             
					87.5%  {   --xamp:".$x[14]."px;    --yamp:".$y[14]."px;   --angle:315deg;}             
					93.75%  {   --xamp:".$x[15]."px;    --yamp:".$y[15]."px;   --angle:337.5deg;}             
    				100%  {   --xamp:".$x[16]."px;    --yamp:".$y[16]."px;   --angle:360deg;}             



              }
			
          .satelite
          {		 
		position:absolute;
	
	         --x:calc( var(--xamp) * cos(var(--angle)) );
		       --y:calc( var(--yamp)  *  sin(var(--angle)));
			   translate:var(--xamp)  var(--yamp);
		    
		       
		      animation:revolve 10s linear infinite;
			  
			  
			  
		

	
            }
			
			
			
			";
			$wa->addInlineStyle($framepiece);
			






?>
<style type="text/css">
.orbitalmechaniclab{
	background-color:<?php echo $params->solarbackgroundcolor; ?>;
	display:grid;

	
}
#infob, #info
{
	border-radius:45%;
	color:#000;
	background-color:#f0f8ff;
	border:1px solid #000;
	display:none;
	width:200px; 
	height:93px;
	text-align:center;
	padding:25px;
	box-sizing: content-box;
	font-size: 12px;
}
#focus
{
	width:100px;
	height:100px;
}
.satelite
{
	position:absolute;
	display:none;
	
}
SVG{
	
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
		 <div>The distance of Satellite from the C.M:<?php echo $a1; ?> meter.</div>
		 <div>The distance of Satellite from the Surface of Planet:<?php echo $params->semi_majoraxis; ?> meter.</div>


	</div>

	<?php if($which==0){ ?>	
	 

<svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $svgwidth; ?>" height="<?php echo $svgheight; ?>">

  <ellipse id="haha" class="orbit" cx="<?php echo $sleft; ?>" cy="<?php echo $stop; ?>" rx="0" ry="0" fill="none"  stroke="blue" stroke-width="15"/>
    Sorry, your browser does not support inline SVG.
	
<?php if ($centermassimg==NULL){ ?>
     <div id="focus" style="margin-left:<?php echo $focusleft-$imagewidth; ?>px; margin-top:<?php echo $focustop-$svgh-$imageheight; ?>px; display:none; font-size:2em" ><img src="<?php uri::base() ?>/administrator/components/com_orbitalmechaniclab/assets/images/earthb.jpg" ></div>
<?php }else{ ?>   
     <div id="focus" style="margin-left:<?php echo $focusleft-$imagewidth; ?>px; margin-top:<?php echo $focustop-$svgh-$imageheight; ?>px; display:none; font-size:2em" ><img src="<?php uri::base() ?><?php echo $centermassimg; ?>" ></div>
<?php } ?>   

 
	 <div id="infob" style=""></div>

</svg>
     <img class="satelite" src="<?php echo uri::base(); ?>administrator/components/com_orbitalmechaniclab/assets/images/sat1.png" width="93px" height="35px"/>

  
	<?php } else { ?>
  	  	<img class="satelite" style="" src="<?php echo uri::base(); ?>administrator/components/com_orbitalmechaniclab/assets/images/sat1.png" width="93px" height="35px"/>

<svg width="<?php echo $svgwidth; ?>" height="<?php echo $svgheight; ?>" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" >
    <!--  <g id="SvgjsG1120" transform="matrix(01,0,0,1,0,0)"> -->
   
		<path id="path"   class="pathorbit1"  d="" stroke="blue" fill="none" stroke-width="15" ></path>
		<path id="pathb"  class="pathorbit2" d="" stroke="blue" fill="none" stroke-width="15" ></path>
		<path id="pathc"  class="pathorbit3" d="" stroke="blue" fill="none" stroke-width="15" ></path>
		<path id="pathd"  class="pathorbit4" d="" stroke="blue" fill="none" stroke-width="15" ></path>
		
<?php if ($centermassimg==NULL){ ?>		
     <div id="focus" style="margin-left:<?php echo $focusleft-$imagewidth; ?>px; margin-top:<?php echo $focustop-$svgh-$imageheight; ?>px; display:none; font-size:2em" ><img  src="<?php uri::base() ?>/administrator/components/com_orbitalmechaniclab/assets/images/earthb.jpg" ></div>
<?php }else{ ?>  
      <div id="focus" style="margin-left:<?php echo $focusleft-$imagewidth; ?>px; margin-top:<?php echo $focustop-$svgh-$imageheight; ?>px; display:none; font-size:2em" ><img src="<?php uri::base() ?><?php echo $centermassimg; ?>" ></div>
<?php } ?>   


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
						jQuery(".satelite").css("display","block");
						//jQuery(".satelite").css("left",fleft+"px");
						//jQuery(".satelite").css("top",s+"px");
						

			 
//, position:"relative", left:fleft+'px', top:s+'px'}


							
						


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
var infoleft;
var infotop;


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
					var scale;

    
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
	  scale= "<?php echo $scale; ?>";
	  
	  	  infotop= "<?php echo $infotop; ?>";
		  infoleft= "<?php echo $infoleft; ?>";


	  

			
			
					jQuery(".pathorbit1").on("mousemove mouseover", function(event){   
					var le;
					var to;
					var X;
					var Y;
					le = jQuery(".pathorbit1").position().left;
					to = jQuery(".pathorbit1").position().top;
					X = event.offsetX ;
					Y = event.offsetY ;
				//	console.log("left:"+fleft);
			//console.log("top:"+ftop);
					//rx = (X-fleft)*50000;
					//ry = (Y-ftop)*50000;
					//rad = Math.pow(rx, 2)+Math.pow(ry, 2)
					//console.log(X+'-'+Y);
						//console.log("rx:"+rx);
			//console.log("ry:"+ry);
					//radius =  Math.sqrt(rad);
								//		radius = Math.sqrt(Math.pow(Math.abs(X - fleft)*50000, 2)+Math.pow(Math.abs(Y - ftop)*50000, 2));
					radius = Math.sqrt(Math.pow(Math.abs(X - fleft)*scale, 2)+Math.pow(Math.abs(Y - ftop)*scale, 2));

				//	console.log('radius'+radius)

				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = (height / base);
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					// centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 centralvelocity = (a * scale * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));

					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));
						radius =  radius.toFixed(2);
					 tangentialvelocity =  tangentialvelocity.toFixed(2);
					 velocity =  velocity.toFixed(2);
					centralvelocity =  centralvelocity.toFixed(2);


					

  try {
    const pointObjb = { x: X, y: Y };
    isP1 = path1.isPointInStroke(pointObjb);

	
	 if(isP1){
					
										//		t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
					//	jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

						jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

						//jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						


	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;
	
	 isP1 = path1.isPointInStroke(pointObjb);

	
	 if(isP1){
					//	t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						//jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

						jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

					//	jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

						
						

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
				//	radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*50000, 2)+Math.pow((Y - ftop)*50000, 2)));
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*scale, 2)+Math.pow((Y - ftop)*scale, 2)));

				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
				//	 centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 centralvelocity = (a * scale * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));

					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));
					
	radius =  radius.toFixed(2);
					 tangentialvelocity =  tangentialvelocity.toFixed(2);
					 velocity =  velocity.toFixed(2);
					centralvelocity =  centralvelocity.toFixed(2);
					


					

  try {
    const pointObjb = { x: X, y: Y };
  
	isP1 = path2.isPointInStroke(pointObjb);
  

	
	 if(isP1){
						//	t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						//jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});
						jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

						//jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						


	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;
	
	isP1 = path2.isPointInStroke(pointObjb);
  
	
	 if(isP1){
						//	t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
					//	jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});
						jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

					//	jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

						
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
				//	radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*50000, 2)+Math.pow((Y - ftop)*50000, 2)));
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*scale, 2)+Math.pow((Y - ftop)*scale, 2)));

				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					// centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					 centralvelocity = (a * scale * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));

					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));
					
	radius =  radius.toFixed(2);
					 tangentialvelocity =  tangentialvelocity.toFixed(2);
					 velocity =  velocity.toFixed(2);
					centralvelocity =  centralvelocity.toFixed(2);
					
					


					

  try {
    const pointObjb = { x: X, y: Y };
 
    isP1 = path3.isPointInStroke(pointObjb);

	
	 if(isP1){
					//	t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
					//	jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

						jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

						//jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						


	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;

   isP1 = path3.isPointInStroke(pointObjb);
	
	 if(isP1){
					//	t1 = pointObjb.y - 500 - 20;			
						//jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
						//jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
							jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

							jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

						//jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

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
				//	radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*50000, 2)+Math.pow((Y - ftop)*50000, 2)));
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*scale, 2)+Math.pow((Y - ftop)*scale, 2)));
console.log(radius);
				//	radius = (integer) radius;
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					 //centralvelocity = (a * 50000 * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					  centralvelocity = (a * radius * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));

					 tangentialvelocity = radius * angularvelocity;
					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));	
						radius =  radius.toFixed(2);
						console.log(radius);
					 tangentialvelocity =  tangentialvelocity.toFixed(2);
					 velocity =  velocity.toFixed(2);
					centralvelocity =  centralvelocity.toFixed(2);
					


					

  try {
    const pointObjb = { x: X, y: Y };
    
   isP1 = path4.isPointInStroke(pointObjb);

	
	 if(isP1){
					//	t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
					//	jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

						jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

						//jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
						

	 }
	
  } catch {
    const pointObjb = svg.createSVGPoint();
    pointObjb.x = X;
    pointObjb.y = Y;
 
    isP1 = path4.isPointInStroke(pointObjb);
	
	 if(isP1){
					//	t1 = pointObjb.y - 500 - 20;			
					//	jQuery("#info").css({marginLeft:pointObjb.x+'px', marginTop: t1 + 'px', display:'block'});
					//	jQuery("#info").css({marginLeft:(lw/2)-200+'px', marginTop: (lh/2)-550 + 'px', display:'block'});
						jQuery("#info").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

					//	jQuery('#info').html('Central Velocity='+centralvelocity+'<br />Tangential Velocity='+tangentialvelocity+'<br /> Velocity='+velocity);		
											jQuery('#info').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		
	

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
var scale;
var infoleft;
var infotop;

 a= "<?php echo $a; ?>";
 b= "<?php echo $b; ?>";
 c = "<?php echo $c; ?>";
 fleft= "<?php echo $focusleft  ?>";
  ecc = "<?php echo $e; ?>";
  angularvelocity =   "<?php echo $angularvelocity; ?>";
   orbitalperiod = "<?php echo $T; ?>";
    peri = "<?php echo $perihelion; ?>";
	 aphi = "<?php echo $aphilion; ?>";
	 	 scale = "<?php echo $scale ?>";
		 	 	 infoleft = "<?php echo $infoleft ?>";
				 infotop = "<?php echo $infotop ?>";


 ftop= "<?php echo $focustop ; ?>";
 s = ftop ;

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
					radius = Math.abs(Math.sqrt(Math.pow((X - fleft)*scale, 2)+Math.pow((Y - ftop)*scale, 2)));

					radius =  radius.toFixed(2);
				
				     base = X - fleft;
					 height = Y - ftop;
                     tang = height / base;
					 cosalpha = 1 / Math.sqrt(1+Math.pow(tang, 2));
					 sinalpha = Math.sqrt(1-Math.pow(cosalpha, 2));
					 denom = 1 + (ecc * cosalpha);
					 centralvelocity = (a * scale * ecc * angularvelocity * sinalpha)/(Math.pow(denom, 2));
					centralvelocity =  centralvelocity.toFixed(2);

					 tangentialvelocity = radius * angularvelocity;
					 					tangentialvelocity =  tangentialvelocity.toFixed(2);

					 velocity = Math.sqrt(Math.pow(centralvelocity, 2)+Math.pow(tangentialvelocity,2));
					 					velocity =  velocity.toFixed(2);


					

  try {
    const pointObj = { x: X, y: Y };
    isP = ellipse.isPointInStroke(pointObj);
	
	 if(isP){
						
						
						jQuery("#infob").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

						jQuery('#infob').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		
											
											
											

	 }
	
  } catch {
    // Fallback for browsers that don't support DOMPoint as an argument
    const pointObj = svg.createSVGPoint();
    pointObj.x = X;
    pointObj.y = Y;
    isP = ellipse.isPointInStroke(pointObj);
	
	 if(isP){
					

						jQuery("#infob").css({marginLeft:infoleft+'px', marginTop: infotop + 'px', display:'block'});

						jQuery('#infob').html('Current Radius='+radius/1000+' km<br />Central Velocity='+centralvelocity+' m/s<br />Tangential Velocity='+tangentialvelocity+'m/s<br /> Velocity='+velocity+' m/s');		

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
		if(semi==a && secondsemi==b)
		{
			clearInterval(interval);
			jQuery("#focus").css("display", "block");
		//	jQuery(".satelite").css({ display:"block", position:"relative", left:fleft+'px', top:s+'px'});
				jQuery(".satelite").css({ display:"block"});


		}

			jQuery(".orbit").attr("ry", secondsemi);
						jQuery(".orbit").attr("rx", semi);


		
	}, 1);
	
	}
if(which == 0)	
	init();
	
	
});
</script>	
		
    




