import * as THREE from '../build/three.module.js';
import {GLTFLoader} from '../jsm/GLTFLoader.js';
import {DRACOLoader} from '../jsm/DRACOLoader.js';

export default class Model3D
{   
    #scene;
    #clips = [];
    #loader;
    #dracoLoader;
    #modelMesh = [];
    #textureLoader;
    glft;
    constructor() {
        // LOADER E DRACOLOADER E RGBELOADER
        this.#loader = new GLTFLoader();
        this.#loader.setCrossOrigin('anonymous');
        this.#dracoLoader = new DRACOLoader();
        this.#dracoLoader.setDecoderPath('https://www.gstatic.com/draco/v1/decoders/'); // decoders do draco
        this.#loader.setDRACOLoader( this.#dracoLoader );

        this.#textureLoader = new THREE.TextureLoader();
    }

    normalMap(normalMapUrl) {
        this.#textureLoader.load(normalMapUrl, (normalMap) => {
            this.#scene.traverse((child) => {
                if (child.isMesh) {
                    child.material.normalMap = normalMap;
                    child.material.needsUpdate = true;
                }
            });
        });
    }

    texture(textureUrl) {
        
        const newTexture = this.#textureLoader.load(textureUrl, (texture) => {

            this.#scene.traverse((child) => {
                
                if (child.isMesh) {
                    const oldTexture = child.material.map;
                    
                    if (oldTexture) {
                        newTexture.offset.copy(oldTexture.offset);
                        newTexture.repeat.copy(oldTexture.repeat);
                        newTexture.center.copy(oldTexture.center);
                        newTexture.rotation = oldTexture.rotation;
                        newTexture.wrapS = oldTexture.wrapS;
                        newTexture.wrapT = oldTexture.wrapT;
                        newTexture.flipY = oldTexture.flipY;
                    }

                    
                    child.material.map = newTexture;
                    child.material.needsUpdate = true;
                }
            });
        });

    }

    textureCV(texture) {
        
        const newTexture = new THREE.CanvasTexture(texture);
        this.#scene.children = this.#modelMesh;
        this.#scene.traverse((child) => {
        
            if (child.isMesh) {
                
                const oldTexture = child.material.map;
                
                if (oldTexture) {
                    newTexture.offset.copy(oldTexture.offset);
                    newTexture.repeat.copy(oldTexture.repeat);
                    newTexture.center.copy(oldTexture.center);
                    newTexture.rotation = oldTexture.rotation;
                    newTexture.wrapS = oldTexture.wrapS;
                    newTexture.wrapT = oldTexture.wrapT;
                    newTexture.flipY = oldTexture.flipY;
                }

                
                child.material.map = newTexture;
                child.material.needsUpdate = true;
            }
        });
    }

    load(file) {
        return new Promise((resolve, reject) => {
            this.#loader.load(file, (gltf) => {

                this.glft = gltf;
                this.#scene = gltf.scene || gltf.scenes[0];
                this.#clips = gltf.animations || [];

                this.#scene.traverse( (child) => {
                    if(child.isMesh) {
                        this.#modelMesh.push(child);
                    }
                })

                // this.#filterMeshModel(this.#scene.children);

                if (!this.#scene) {
                    // Valid, but not supported by this viewer.
                    throw new Error(
                        'Nâo contem cena' +
                            ' - Verificar o modelo se é gltf ou glb',
                    );
                }
+
                resolve(gltf.scene || gltf.scenes[0]);
            }, undefined, (error) => {
                reject(error);
            });
        });
    }

    getClip() { return this.#clips;}
    getMesh() { return this.#modelMesh}
    getScene() { return this.#scene}

    setColorAllMesh(color) {
        this.#modelMesh.forEach( item => {
            item.material.color = new THREE.Color(color);
        });
    }

    #filterMeshModel(children) {

        let child;
        let count = children.length;
        
        if(count === 0) {return Array() ;}

        for (let i = 0; i < count; i++ ) {

            child = children[i];

            if( child.type === 'Mesh' ) {
                this.#modelMesh.push(child);
                child.children.splice(i,1);
            }

            if(child.children) {
                this.#filterMeshModel(child.children);
            }

        }
    }

}