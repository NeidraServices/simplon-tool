import axios from 'axios';


let API_URL

if (!process.env.NODE_ENV || process.env.NODE_ENV === 'development') {
    API_URL = `${location.origin}/api/markedown`
} else {
    API_URL = 'http://31.220.54.89/api/markedown'
}

export class APIService {
    getApiCategories() {
        const url = `${API_URL}/categories`;
        return axios.get(url);
    } 

    search(val) {
        const url = `${API_URL}/categorie/search`;        
        return axios.get(url,{ params: { query: val } });
    }

    getApiMdCommuns() {
        const url = `${API_URL}/markdowns-commun`;
        return axios.get(url);
    }
    getApiMyMds() {
        const url = `${API_URL}/my-markdowns`;
        return axios.get(url);
    }
    getApiMyArchives(id) {
        const url = `${API_URL}/markdown/archives/${id}`;
        return axios.get(url);
    }
    getApiMdDetails(id) {
        const url = `${API_URL}/my-markdowns?id=${id}`;
        return axios.get(url);
    }

    updateStatus(dataSend, id) {
        console.log("datatosend :"+id,dataSend)
        const url = `${API_URL}/markdown/active/${id}`;
        return axios.post(url, dataSend);
    }
}