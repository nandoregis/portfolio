import Viewer from "../../../module/Viewer.js";
import { enableUVMolde } from "./config.js";
import  "./editorEvents.js";

const renderModel = document.getElementById('render');
const loading = document.querySelector('.tools__loading');

( async () => {
  
    const view = new Viewer(renderModel);
    const urlApi = 'https://visualapi.nellure.com';

    const uuidModel = document.getElementById('uuidModelo').value;
    const uuidReferencia = document.getElementById('uuidRef').value;

    const textures = await fetch(`${urlApi}/v1/references/textures/${uuidReferencia}`);
    const texturesJson = await textures.json();
    
    const model  = await fetch(`${urlApi}/v1/models/${uuidModel}`);
    const modelJson = await model.json();
    
    let modelo3d = await view.addModel(modelJson.diretorio); 
    
    await enableUVMolde(modelJson.diretorio_uv, modelo3d, texturesJson);
    await view.run();
    
    loading.classList.add('hide');

})();







