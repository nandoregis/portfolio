import { deleteImgFromTexture, getMolde, scaleCanvasToDivSize, textureGenerator, publicRef, refColorsBtn } from "./config.js";
import cvFabric from "./cvFabric.js";
import { pressedKey } from "./keysEvents.js";

const fileInput = document.getElementById('up-img');
const render = document.getElementById('render');
const btnRemove = document.getElementById('btn-remove');
const btnRender = document.getElementById('btn-render');
const btnPublic = document.getElementById('btn-public');

const keyEvents = (e) => {
   pressedKey(e).action();
}

const inputEvent = (event) => {
   const file = event.target.files[0];
   const reader = new FileReader();
   let molde = getMolde();
  
   let scX, scY;

   reader.onload = function (f) {
       const imgElement = new Image();
       imgElement.src = f.target.result;

       imgElement.onload = function () {
           
           scY = scX = imgElement.width >= molde.width || (imgElement.width*2) >= molde.width ? 0.5 : 1;
           scY = scX = (imgElement.width/2) >= molde.width ?  0.2 : scX;

           const imgInstance = new fabric.Image(imgElement, {
               left: 0,
               top: 0,
               scaleX: scX,  // Redimensionar a imagem
               scaleY: scY,  // Redimensionar a imagem
               angle: 0,
               opacity: 1
           });

           cvFabric.add(imgInstance).renderAll();
       };
   };
   
   reader.readAsDataURL(file);
   fileInput.value = '';
}

export default ( () => {

    // EVENTO DE PEGAR IMG DO INPUT
    fileInput.addEventListener('change', inputEvent);
    // Evento global de escutar teclas e de resize do molde
    window.addEventListener('keydown', keyEvents);
    window.addEventListener('resize', scaleCanvasToDivSize);
    
    render.addEventListener('mousedown', () => { render.classList.add('grabbing') });
    render.addEventListener('mouseup', () => { render.classList.remove('grabbing') });

    btnRender.addEventListener('click', () => textureGenerator());
    btnRemove.addEventListener('click', deleteImgFromTexture);

    btnPublic.addEventListener('click', publicRef);
    refColorsBtn();
    
})();









