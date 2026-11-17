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

$a = 200;
$e = 0.2;
$c = ($a * $e);
$B = pow($a, 2) - pow($c, 2);
$b = sqrt($B);
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







?>
<style type="text/css">
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
         
		 				
        
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500">
  <ellipse id="haha" class="orbit" cx="240" cy="150" rx="0" ry="0" fill="none"  stroke="blue" stroke-width="5"/>
  
  Sorry, your browser does not support inline SVG.
</svg>

  
<svg width="1000" height="1000" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="top: 0px; left: 0px; position: relative;">
    <!--     <g id="SvgjsG1120" transform="matrix(01,0,0,1,0,0)">-->
   
		<path id="path"  d="" stroke="black" fill="none" stroke-width="5" ></path>
		<path id="pathb"  d="" stroke="black" fill="none" stroke-width="5" ></path>
		<path id="pathc"  d="" stroke="black" fill="none" stroke-width="5" ></path>
		<path id="pathd"  d="" stroke="black" fill="none" stroke-width="5" ></path>



	<!--	</g>-->
    
</svg>



		
	</div>	
<script type="text/javascript">

(function(){
	
    window.el = document.getElementById("path");
	    window.elb = document.getElementById("pathb");
			    window.elc = document.getElementById("pathc");
							    window.eld = document.getElementById("pathd");




    const x0 = 0;
    var x1=0;
    var x2=500;
    var y0=200;
    const y1 = 200;
	var y11=100;
    const y2 = 300;
	var intervala;
	var intervalb;
	var intervalc;
	var intervald;


	
	var x0b = 500;
	var y0b = 100;

    var top = `${x1} ${y0}`;
    const middle = `${x1} ${y1}`;
    var x111=1000;
    var y111=200;
    var bottom = `${x111} ${y111}`;
    var left = `${x0} ${y1}`;
	var right = `${x2} ${y11}`;
	var x1111=500;
	var y1111=300;


	var d;
	function inita()
	{
		if(y0>100)
			y0--;
		if(x1<500)
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
		if(y11<200)
			y11++;
		if(x2<1000)
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
		if(y111<300)
			y111++;
		if(x111>500)
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
		if(y1111>200)
			y1111--;
		if(x1111>0)
			x1111--;
		else
		{
			clearInterval(intervald);
		}
		    left = `${x1111} ${y1111}`;

		
		  d4 = `M ${bottom} ` +
			     `C ${bottom} ${x1111} ${y111} ${left} `;
						

			                

			                
    window.eld.setAttribute('d', d4);
	intervald= setInterval(function(){
		initd();
	}, 90);
	}
	
	inita();
})();


var semi;
var secondsemi;
var interval;
semi=0;
secondsemi=0;
jQuery(document).ready(function(){
	
	  let isP;
					  const svg = document.getElementsByTagName("svg")[0];
					  const ellipse = document.getElementById("haha");
	function init(){
		
		
					jQuery(".orbit").on("mousemove mouseover", function(e){   
					//e.clientX may not be compatible with pointstroke scale, check and change it in case.
					var l;
					var t;
					var X;
					var Y;
					l = jQuery(".orbit").position().left;
					t = jQuery(".orbit").position().top;
					X = e.offsetX ;
					Y = e.offsetY ;


					

  try {
    const pointObj = { x: X, y: Y };
    isP = ellipse.isPointInStroke(pointObj);
	
	 if(isP){
						console.log(pointObj.x);
											console.log(pointObj.y);

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
	 }
  }

      
					});

		
		
	interval = setInterval(function(){
		
		if(semi<100 )
			semi++;
		if(secondsemi<220)
			secondsemi++
		else
			clearInterval(interval);

			jQuery(".orbit").attr("ry", semi);
						jQuery(".orbit").attr("rx", secondsemi);


		
	}, 1)
	}
	
	//init();
	
	
});
</script>	
		
    




