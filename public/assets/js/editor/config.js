import cvFabric from "./cvFabric.js";

var molde, modelo3d, colorInputRender;
const moldeContainer = document.getElementById('molde__container');
const URL_API = 'https://visualapi.nellure.com';

export async function enableUVMolde (urlMolde, m3d, textures) {
    return new fabric.Image.fromURL(urlMolde, function(oImg) {
        molde = oImg;
        modelo3d = m3d;

        cvFabric.setWidth(molde.width)
        cvFabric.setHeight(molde.height);
    
        molde.set({
            left: 10,
            top: 10,
            angle: 0,
            opacity: 1,
            selectable: false,     // Desabilita a seleção
            evented: false,        // Desabilita todos os eventos
            lockMovementX: true,   // Desabilita movimento horizontal
            lockMovementY: true,   // Desabilita movimento vertical
            lockScalingX: true,    // Desabilita redimensionamento horizontal
            lockScalingY: true,    // Desabilita redimensionamento vertical
            lockRotation: true,    // Desabilita rotação
            hasControls: false     // Remove os controles de manipulação
        })
    
        scaleCanvasToDivSize();
        cvFabric.add(molde).renderAll();

        checkExistTextureAndAdd(textures)
    }, {
        crossOrigin: 'anonymous'
    });
}

/**
 * REDIMENCIONA O MOLDE DE ACORDO COM TAMANHO DA PAGINA.
 */
export function scaleCanvasToDivSize() {
    const scaleRatioX = moldeContainer.clientWidth / cvFabric.width;
    const scaleRatioY = moldeContainer.clientHeight / cvFabric.height;
    cvFabric.setZoom(Math.min(scaleRatioX, scaleRatioY));
}

export function getMolde() { return molde }

/**
 * DEIXAR O MOLDE INVISIVEL PARA CRIAR TEXTURA CORRETAMENTE
 * @param {*} bool 
 */
function toggleVisibility(bool) {
    if (molde) {
        molde.visible = bool; // Alterna a visibilidade
        // cvFabric.renderAll(); // Renderiza o canvas novamente
    }
}

/**
 * LIMITA MOVIMENTOS DA IMAGEM DENTRO DO CANVAS.
 */
export const canvasLimit = (obj = {}) => {
    
    if (obj.left < 0) {
        obj.left = 0;
    }
    if (obj.top < 0) {
        obj.top = 0;
    }
    if (obj.left + obj.width * obj.scaleX > cvFabric.width) {
        obj.left = cvFabric.width - obj.width * obj.scaleX;
    }
    if (obj.top + obj.height * obj.scaleY > cvFabric.height) {
        obj.top = cvFabric.height - obj.height * obj.scaleY;
    }
}

cvFabric.on('object:moving', function (options) {
    canvasLimit(options.target);
});

/**
 * CRIAR A TEXTURA DO CANVAS E JÁ RENDERIZA NO MODELO 3D
 */
export function textureGenerator() {
    toggleVisibility(false);
    cvFabric.setZoom(1);
    cvFabric.backgroundColor = colorInputRender ? colorInputRender : '#ccc';
    cvFabric.discardActiveObject();
    cvFabric.renderAll();
    
    modelo3d.textureCV(cvFabric.getElement()); 

    scaleCanvasToDivSize();
    cvFabric.backgroundColor = null;
    toggleVisibility(true);

}

export const refColorsBtn = () => {
    const refColor = document.querySelectorAll('.ref-color');
    refColor.forEach(el => {
        el.addEventListener('click', () => {
            let color = el.getAttribute('color');
            colorInputRender = color;
            textureGenerator();
        })
    });
}

// criar funcão que adiciona imagens automaticamente nas suas posições

const checkExistTextureAndAdd = async (objects) => {
    
    if(objects) {

        objects.forEach( imgData => {
            const urlImg = imgData.diretorio;
    
            const image = new fabric.Image.fromURL(urlImg, function(oImg) {
                oImg.set({
                    uuid: imgData.uuid,
                    name: imgData.nome,
                    left: imgData.pos_x,
                    top: imgData.pos_y,
                    width:  imgData.largura,
                    height: imgData.altura,
                    angle: imgData.angulo,
                    file_exist: imgData.file_exist,
                    opacity: 1,
                    lockScalingX: true, // bloqueia redimensionamento horizontal
                    lockScalingY: true, // bloqueia redimensionamento vertical
                    hasControls: true   // ainda mostra controles (exceto escala)
                })
    
                cvFabric.add(oImg).renderAll();
                textureGenerator();   
            }, {
                crossOrigin: 'anonymous'
            });

        });

    }
}

export const publicRef = () => {

    const uuidReferencia = document.getElementById('uuidRef').value;
    const uuidusuario = document.getElementById('uuid').value;
    const objects = cvFabric.getObjects();
    objects.shift(); // remove o molde.

    if(objects.length === 0) {
        alert('Não pode publicar se não existe imagem');
        return;
    }
    
    const objectsModify = objects.map((img) => {
        return { 
            uuid: img.uuid || "",
            uuid_usuario: uuidusuario,
            uuid_referencia: uuidReferencia, 
            nome: img.cacheKey+'.png',
            largura: img.width * img.scaleX,
            altura: img.height * img.scaleY,
            pos_x: img.left,
            pos_y: img.top,
            angulo: img.angle,
            file_exist : img.file_exist || false,
            file: img.toDataURL()
        }
    });

    fetch(`${URL_API}/v1/textures/new`, {
        method: 'POST',
        body: JSON.stringify(objectsModify)
    })
    .then(res => {
        window.location.reload();
    })
    .then(data => console.log(data));

}

export const deleteImgFromTexture = () => {

    let obj = cvFabric.getActiveObject();
    if(!obj) {
        alert('Selecione uma imagem para poder remover');
        return;
    }

    // verificar se existe uuid, para quando deletar, fazer um delete para o banco de dados e upload do arquivo 
    if(obj.uuid) {

        const uuid = obj.uuid;

        console.log(obj.name);

        fetch(`${URL_API}/v1/textures/delete`, {
            method: 'POST',
            body: JSON.stringify({uuid: uuid, name: obj.name})
        })
        .then(res => {
            console.log(res.text())
        })
        .then(data => console.log(data));
        
    }


    cvFabric.remove(obj);
    textureGenerator();
}

