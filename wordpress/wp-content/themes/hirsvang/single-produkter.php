<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>


		<div id="primary" class="content-area">
		<main id="main" class="site-main">


		<section id="popup">
      
		  		<button class="luk">Tilbage</button>
          


        <article>
            <div>
  <p id="shopside"></p>
<img src="" class="imgmini" id="pic" onclick="changeImage(this.src)"></img>
<img src="" class="imgmini" id="pic2" onclick="changeImage(this)" ></img>
<img src="" class="imgmini" id="pic3" onclick="changeImage(this)" ></img>
<img src="" class="imgmini" id="pic4" onclick="changeImage(this)" ></img>

</div>

<div class="ryk">
   <div class="box">
      <div class="circle"></div>
      <div class="line"></div>
      <div class="circle"></div>
    </div>
		<h3 class="titel"></h3>
    <p class="beskrivelse"></p> 
		<p class="pris"></p> 
	  <div class="kurv">		  		<button>Læg i kurv</button>
    </div>



	<div class="gave">	
		
<p>Lad os klare gaveindpakningen og overrask en, du holder af 
med et personligt kort. Vi kan sende direkte til gavemodtager.</p>
<button type="button" data-modal-target="#modal" ><svg width="32" height="32" viewBox="0 0 512 512"><path fill="none" stroke="#888888" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M256 104v56h56a56 56 0 1 0-56-56Zm0 0v56h-56a56 56 0 1 1 56-56Z"/><rect width="384" height="112" x="64" y="160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" rx="32" ry="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M416 272v144a48 48 0 0 1-48 48H144a48 48 0 0 1-48-48V272m160-112v304"/></svg>Send som gave</button>
  <div class="modal" id="modal">
    <div class="modal-header">
      <div class="title"><h3>Hvordan skal gaven se ud?</h3></div>
      <button data-close-button class="close-button">Luk &times;</button>
	  
    </div>
    <div class="modal-body">
 <h4>Vælg gavepapir:</h4>
<div id="gavepapir">
<div class="gavepapirboks1">
  <img src="<?php echo get_stylesheet_directory_uri() ?>/billeder/julepapir.png">

<p>Julet Gavepapir</p>
<p> Pris 15,00KR</p>
<label class="container">Vælg
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
</div>
<div class="gavepapirboks2">
<img src="<?php echo get_stylesheet_directory_uri() ?>/billeder/lyseblå.png">

<p>Lyseblåt Gavepapir</p>
<p> Pris 15,00KR</p>
<label class="container">Vælg
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
</div>
<div class="gavepapirboks3">
<img src="<?php echo get_stylesheet_directory_uri() ?>/billeder/lyserød.png">
<p>Lysrødt Gavepapir</p>
<p> Pris 15,00KR</p>
<label class="container">Vælg
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
</div>

</div>



<h3>Alt vores gavepapir er FSC - Certificeret</h3>
<h4>Vælg kort til gave:</h4>
	<div id="kort">
<div class="kort1">
    <img src="<?php echo get_stylesheet_directory_uri() ?>/billeder/træ.png">

<p>Kort med juletræ</p>
<p> Pris 15,00KR</p>
<label class="container">Vælg
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
</div>
<div class="kort2">
      <img src="<?php echo get_stylesheet_directory_uri() ?>/billeder/ballon.png">


<p>Kort med balloner</p>
<p> Pris 15,00KR</p>
<label class="container">Vælg
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
</div>
<div class="kort3">
    <img src="<?php echo get_stylesheet_directory_uri() ?>/billeder/kage.png">

<p>Kort med kage</p>
<p> Pris 15,00KR</p>
<label class="container">Vælg
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
</div>
  </div>
  

  
  <div id="hilsen">
<p>Vælg et kort for at skrive en hilsen </p>
<div class="til">
    <input type="text"value="Til:">	
	<p>Skriv modtagers navn</p>
</div>
<div class="fra">

	<input type="text"value="Fra:" >	
	<p>Skriv afsenders navn</p>
	</div>

</div>
<p>Skriv din hilsen (maks. 170 tegn)</p>

<div id="counter"></div>
<textarea  maxlength="170" id="message" >Kære...</textarea>
    <input type="submit" value="Submit">

   <div id="overlay"></div> 

</div>

</div>
</div>


        </article>
      	</section>	
		</main>
    
	




    





	<script> 
function changeImage(img) {
document.getElementById("pic").src=img.src;
document.getElementById("shopside").innerText = img.alt
  
 }
		//Find parametre (variabler) i url'en
		//Let urlParams = new URLSearchParams(window.location.search);
		//Returner værdien for variablen "id"
		//Let id = urlParams.det("id");

		let produkter;
		document.addEventListener("DOMContentLoaded", getJson);

		async function getJson() {
			console.log("id er", <?php echo get_the_ID() ?>);
			//Hent en enkelt ret udfra id'et
			let jsonData = await fetch("https://madsschou.dk/kea/hirsvang/wordpress//wp-json/wp/v2/produkter/<?php echo get_the_ID() ?>");
			produkter = await jsonData.json();
			console.log(produkter);
      			visProdukter();

		}

  
		//Vis data om "Produkter"
		function visProdukter() {
			document.querySelector(".beskrivelse").innerHTML = produkter.beskrivelse;
			document.querySelector(".pris").innerHTML = produkter.pris;
			document.querySelector(".titel").innerHTML = produkter.titel;
			document.querySelector("#pic").src = produkter.pic.guid;
      document.querySelector("#pic2").src = produkter.pic2.guid;
      document.querySelector("#pic3").src = produkter.pic3.guid;
      document.querySelector("#pic4").src = produkter.pic4.guid;



		

			document.querySelector("article").addEventListener("click", () => {
	//popup.style.display = "none"
	//console.log("KLIK",produkter._links.self[0])
	// location.href = produkter.link;
})
liste.appendChild(klon);
}

			document.querySelector(".luk").addEventListener("click", () => {
			//Link tilbage til den foregående side på "luk knappen"
			history.back();
		})







// popop på singleview

const openModalButtons = document.querySelectorAll('[data-modal-target]')
const closeModalButtons = document.querySelectorAll('[data-close-button]')
const overlay = document.getElementById('overlay')

openModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = document.querySelector(button.dataset.modalTarget)
    openModal(modal)
  })
})

overlay.addEventListener('click', () => {
  const modals = document.querySelectorAll('.modal.active')
  modals.forEach(modal => {
    closeModal(modal)
  })
})

closeModalButtons.forEach(button => {
  button.addEventListener('click', () => {
    const modal = button.closest('.modal')
    closeModal(modal)
  })
})

function openModal(modal) {
  if (modal == null) return
  modal.classList.add('active')
  overlay.classList.add('active')
}

 function closeModal(modal) {
  if (modal == null) return
  modal.classList.remove('active')
   overlay.classList.remove('active')
 }

/*Tegn*/
const messageEle = document.getElementById('message');
const counterEle = document.getElementById('counter');

messageEle.addEventListener('input', function (e) {
    const target = e.target;

    // Get the `maxlength` attribute
    const maxLength = target.getAttribute('maxlength');

    // Count the current number of characters
    const currentLength = target.value.length;

    counterEle.innerHTML = `${currentLength}/${maxLength}`;



}); 
/*Fjern defaulttext fra */

</script> 




