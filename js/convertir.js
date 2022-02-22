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