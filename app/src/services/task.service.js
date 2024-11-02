import httpClient from "./http.service";

const taskService = {
    async getTaskList(){
        try {
            const {status, data} = await httpClient.post('task/list');
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
    async getTask(id){
        try {
            const {status, data} = await httpClient.post('task/task', id);
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
    async takeTask(id){
        try {
            const {status, data} = await httpClient.post('task/take', id);
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
    async taskInspection(id){
        try {
            const {status, data} = await httpClient.post('task/inspection', id);
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
    async taskRefuse(id){
        try {
            const {status, data} = await httpClient.post('task/refuse', id);
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
    async taskFinish(id){
        try {
            const {status, data} = await httpClient.post('task/finish', id);
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
};
export default taskService;