import Viewer from "../../../module/Viewer.js";

( async () => {
  
    const renderModel = document.getElementById('render');
    const view = new Viewer(renderModel);
    const modelo = await view.addModel('http://app-portfolio.localhost/robot.glb'); 
    await view.run();

})();







