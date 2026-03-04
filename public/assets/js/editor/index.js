import Viewer from "../../../module/Viewer.js";
import { enableUVMolde } from "./config.js";
import  "./editorEvents.js";

const renderModel = document.getElementById('render');
const loading = document.querySelector('.tools__loading');

( async () => {
  
    const renderModel = document.getElementById('render');
    const view = new Viewer(renderModel);
    const modelo = await view.addModel('http://localhost/camiseta.glb'); 
    await view.run();

})();







