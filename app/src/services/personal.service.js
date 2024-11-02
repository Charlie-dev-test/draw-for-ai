import httpClient from "./http.service";
import authService from "./auth.service";
import offerServices from "./offer.service";

const personalService = {
    async getPersonal(){
        try {
            const {status, data} = await httpClient.post('data/account');
            if(status === 200){
                return {
                    success: true,
                    data:data
                }
            }
        } catch(e){
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },

    async setPersonal(formData){
        try {
            const {status, data} = await httpClient.post('data/profile', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            if(status === 200){
                return {
                    success: true,
                    data:data
                }
            }
        } catch(e){
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },

    async deleteUser(){
        try{
            const {status} = await httpClient.post('user/remove');
            if(status === 200){
                authService.logout()
            }
            return {
                success: true
            }
        } catch(e){
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },
    async getStatus(){
        try{
            const {status, data} = await httpClient.post('data/status');
            if(status === 200){
                authService.setStatus(data.status);
                offerServices.setUserToken(data.offer_user);
            }
            return {
                success: true
            }
        } catch(e){
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },
};

export default personalService;