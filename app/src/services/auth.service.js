import httpClient from "./http.service";
import router from "../router";
import offerServices from "./offer.service";

const authService = {
    user: null,
    async login(formData){
        try {
            const {status, data} = await httpClient.post('user/login', formData);
            if (status === 200){
                if (status === 200) {
                    this.setUser(data);
                    this.setStatus(data.status);
                    offerServices.setToken(data.token);
                    offerServices.setUserToken(data.offer_token);
                }
                return {
                    success: true
                }
            }
        } catch(e){
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },
    async register(formData){
        try {
            const {status, data} = await httpClient.post('user/register', formData);
            if (status === 200){
                if (status === 200) {
                    this.setUser(data);
                    this.setStatus(0);
                    offerServices.setToken(data.offer_token);
                    offerServices.setUserToken(data.offer_token);
                }
                return {
                    success: true
                }
            }
        } catch(e){
            return {
                success: false,
                errors: e.response.data.errors
            }
        }
    },
    setUser(user){
        this.user = user;
        localStorage.setItem('ACCESS_TOKEN', user.access_token);
    },
    isLoggedIn(){
        return localStorage.getItem('ACCESS_TOKEN') !== null;
    },
    logout() {
        localStorage.removeItem('ACCESS_TOKEN');
        offerServices.unsetToken();
        offerServices.usetUserToken();
        localStorage.setItem('auth', "false");
        router.push({name: 'Login'});
    },
    getToken() {
        return localStorage.getItem('ACCESS_TOKEN');
    },
    setStatus(status){
        localStorage.setItem('USER_STATUS', status);
    },
    getStatus(){
        return localStorage.getItem('USER_STATUS');
    },
    isPending(){
        return this.getStatus() === '1';
    },
    isChecked(){
        return this.getStatus() === '2';
    }
};

export default authService;