// document.addEventListener("DOMContentLoaded",
function Primera(e){ 
  // let str = e.value;
  //  e.value = (str[0].toUpperCase() + str.slice(1).toLowerCase());
  let valorEntrada = e.value;
  let splitValorEntrada = valorEntrada.split(" ");
  let mayusSplitValorEntrada = splitValorEntrada.map(palabra => {
    return palabra[0].toUpperCase() + palabra.slice(1).toLowerCase();
})
    NuevoValor = mayusSplitValorEntrada.join(" ");
    //e.value = mayusSplitAprendeAProgramar;
    e.value = NuevoValor;
    // e.value = (str[0].toUpperCase() + str.slice(1).toLowerCase());
  
}

function rfcMayus(e){
  let rfc = e.value;
  e.value = rfc.toUpperCase();
}