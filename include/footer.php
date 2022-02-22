<footer>
<div class="site-footer">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
             <h2>Acerca de la División de Estudios de Posgrado</h2> 
            </div>
          </div>
        </div>      
  </div> 

<!-- <script src="assets/js/convertir.js"> -->
  <script>
 function Primera(e){ 
  // let str = e.value;
  //  e.value = (str[0].toUpperCase() + str.slice(1).toLowerCase());
  let aprendeAProgramar = e.value;
  let splitAprendeAProgramar = aprendeAProgramar.split(" ");
  let mayusSplitAprendeAProgramar = splitAprendeAProgramar.map(palabra => {
    return palabra[0].toUpperCase() + palabra.slice(1).toLowerCase();
})
    NuevoAprendeAProgramar = mayusSplitAprendeAProgramar.join(" ");
    //e.value = mayusSplitAprendeAProgramar;
    e.value = NuevoAprendeAProgramar;
    // e.value = (str[0].toUpperCase() + str.slice(1).toLowerCase());
  
} 

</script>
<script>
window.onscroll=function(){
    document.getElementById('navbar').setAttribute('class',(window.pageYOffset>5?'fixednav clearfix':'clearfix'));
}
</script>

<script>
(function(){
    var $body=document.body,$menu_trigger=$body.getElementsByClassName('menu-trigger')[0];
    if(typeof $menu_trigger!=='undefined'){$menu_trigger.addEventListener('click',function(){$body.className=($body.className=='menu-active')?'':'menu-active';});}}).call(this);
</script>
</footer>