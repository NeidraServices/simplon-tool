import axios from 'axios';


let API_URL

if (!process.env.NODE_ENV || process.env.NODE_ENV === 'development') {
    API_URL = 'http://localhost:8000/api/markedown'
} else {
    API_URL = 'http://31.220.54.89/api/markedown'
}

export class APIService {
    // register(user) {
    //     const url = `${API_URL}/register`;
    //     return axios.post(url, user);
    // }
    test(){
        console.log("test")
    }
    getApiCategories() {
        const url = `${API_URL}/categories`;
        return axios.get(url);
    }
}