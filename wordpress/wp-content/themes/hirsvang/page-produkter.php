<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>




	<div id="primary" class="content-area">

		<section class="h1class">
      </section>
  <div class="produktfiltrering">

            <p>
                Produkter
            </p>
            </div>
<nav id="filtrering"></nav>
<!-- <button class="filter" data-produkter="alle">Alle</button> -->
          
<section id="produktercontainer"></section>

		<main id="main" class="site-main">

			<section id="udvalg"></section>
			<template id="produkterTemplate">
				<article>
                            		 
        <div class="productimages"> <img src="" alt="billede" /></div>

        <p class="titel"></p> 	
        <h5 class=".overskrift"></h5>
        <p class="pris"></p>
        <button class="kurvlaeg"></button>
       

				</article>
			</template>	

		</main>
		</div>
  
	
<script>
    //Fin URL til Json
    //const siteUrl = "https://madsschou.dk/kea/hirsvang/wordpress//wp-json/wp/v2/produkter/"
    let produkterUdvalg = [];
    let categories = [];
    let indhold = [];
    const produkterTemplate = document.querySelector("#produkterTemplate");
    const liste = document.querySelector("#udvalg");
    let filterProdukter = "alle";
    let filterIndhold = "alle";
    const queryString = window.location.search;
     console.log(queryString);
     const urlParams = new URLSearchParams(queryString);
    const kategori =  urlParams.get("kategori");

    if (kategori > 0){filterProdukter = kategori}
    console.log(kategori);

    
    document.addEventListener("DOMContentLoaded", start);
function start() {
	// console.log("id er", <?php echo get_the_ID() ?>);
	// console.log(siteUrl);
	getJson();
}


async function getJson(){
	//const url = siteUrl + "?per_page=100";
	const catUrl = "https://madsschou.dk/kea/hirsvang/wordpress//wp-json/wp/v2/categories";
	const contUrl = "https://madsschou.dk/kea/hirsvang/wordpress//wp-json/wp/v2/produkter/?per_page=100";
//const response = await fetch(siteUrl);
let catResponse = await fetch(catUrl);
let contResponse = await fetch(contUrl);

categories = await catResponse.json();
indhold = await contResponse.json();

console.log("Categories",categories)
console.log("Indhold",indhold)
visProdukter();
 opretKnapper();
}

function opretKnapper() {
	categories.forEach(cat=> {
		//console.log(cat.id)
		if (cat.name != "Uncategorized") {
            console.log("cat.name",cat.name)
        document.querySelector("#filtrering").innerHTML += `<button class="filter" data-produkter="${cat.id}">${cat.name}</button>`
}
		})
		// indhold.forEach(cont=>{
		// 	//console.log(cont.id);
		// 	document.querySelector("#indhold-filtrering").innerHTML += '<button class="filter" data-cont="${cat.id}">${cat.name}</button>'
		// })
        addEventListenersToButtons();
}
function addEventListenersToButtons(){
            document.querySelectorAll("#filtrering .filter").forEach(elm => {
                elm.addEventListener("click", filtrering);
            })
            // documemt.querySelectorAll("#indhold-filtrering button").forEach(elm => { 
            //     elm.addEventListener("click", filtreringIndhold);
            //     })
}
function filtrering(){
    filterProdukter = this.dataset.produkter;
    console.log("filterProdukter =",filterProdukter);
   visProdukter();
}



 
 function visProdukter(){
 	//let temp = document.querySelector("#produkterTemplate");
 	let container = document.querySelector("#produktercontainer");
     liste.innerHTML = "";

     indhold.forEach(produkter =>{
         //parseInt = får browseren til at opfatte det som tal istedetfor tekst, i attributen.
         
if (filterProdukter == "alle" || produkter.categories.includes(parseInt(filterProdukter))){
           
             
        
         const klon = produkterTemplate.cloneNode(true).content;
         console.log("Klon",klon)
         klon.querySelector("h5").textContent = produkter.title.rendered;   
         klon.querySelector(".pris").textContent = produkter.pris;    
         klon.querySelector(".titel").textContent = produkter.titel;  
         klon.querySelector(".kurvlaeg").textContent = produkter.kurvlaeg;  

        klon.querySelector("img").src = produkter.pic.guid;
         klon.querySelector(".kurvlaeg").addEventListener("click", () => {
 	//popup.style.display = "none"
 	//console.log("KLIK",hold._links.self[0])
 	location.href = produkter.link;
     })
     liste.appendChild(klon);
     }
     })
 }





</script>

<?php
get_footer();?>





 




	
		
