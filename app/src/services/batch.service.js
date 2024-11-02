import httpClient from "./http.service";
import authService from "./auth.service";
// import { encode } from "base64-arraybuffer";
const batchService = {
    async getBatchList(){
        try {
            const {status, data} = await httpClient.post('batch/list');
            if(status === 200) {
                return {
                    success: true,
                    data: data
                }
            }
        } catch(e){
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },
    async getBatch(id){
        try {
            const {status, data} = await httpClient.post('batch/batch', {"id":id});
            if(status === 200) {
                return {
                    success: true,
                    data: data
                }
            }
        } catch(e){
            if(e.response.data.errors === 422){
                authService.logout();
            }
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },
    async saveData(formData){
        try {
            const {status, data} = await httpClient.post('batch/data', formData);
            if(status === 200) {
                return {
                    success: true,
                    data: data
                }
            }
        } catch(e){
            if(e.response.data.errors === 422){
                authService.logout();
            }
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    }
    // async nextImage(){
    //     const resp = await httpClient.post('batch/image');
    //     console.log(resp);
    //     const chunk = await resp.arrayBuffer();
    //     const base64 = encode(chunk);
    //     let image = new Image();
    //     image.src = 'data:image/jpeg;base64,'+base64;
    //     document.getElementById('test-image').appendChild(image)
    // }
};

export default batchService;