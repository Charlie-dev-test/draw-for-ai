import httpClient from "./http.service";

const offerServices = {
    async getActiveOffer(){
        try {
            const {status, data} = await httpClient.post('offer/last');
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
    async getActiveOfferToken() {
        try {
            const {status, data} = await httpClient.post('offer/token');
            if (status === 200){
                this.setToken(data.token);
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
    async setNewOffer(formData) {
        try {
            const {status, data} = await httpClient.post('offer/set', formData);
            if (status === 200){
                this.setToken(data);
                this.setUserToken(data);
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
    setToken(token){
        localStorage.setItem('ACTIVE_OFFER', token)
    },
    getToken(){
      return localStorage.getItem('ACTIVE_OFFER')
    },
    unsetToken(){
        localStorage.removeItem('ACTIVE_OFFER')
    },
    setUserToken(token){
        localStorage.setItem('USER_OFFER', token)
    },
    getUserToken(){
        return localStorage.getItem('USER_OFFER')
    },
    usetUserToken(){
        localStorage.removeItem('USER_OFFER')
    },
    compareTokens(){
      return this.getToken() === this.getUserToken();
    },
};

export default offerServices;