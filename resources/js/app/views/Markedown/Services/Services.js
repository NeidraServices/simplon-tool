import axios from 'axios';


let API_URL

if (!process.env.NODE_ENV || process.env.NODE_ENV === 'development') {
    API_URL = `${location.origin}/api/markedown`
} else {
    API_URL = 'http://31.220.54.89/api/markedown'
}

export class APIService {
    getRequestHeadersToSend(){
        let token = localStorage.getItem('token');
        return {headers: {'Authorization': `Bearer ${token}`}}
    }

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
    contributionRequest(id) {
        const headers = this.getRequestHeadersToSend();
        const url = `${API_URL}/contribution/${id}`;
        return axios.get(url,headers);
    }
    acceptContribution(id){
        const headers = this.getRequestHeadersToSend();
        const url = `${API_URL}/contribution/accept/${id}`;
        return axios.get(url,headers);
    }
    declineContribution(id){
        const headers = this.getRequestHeadersToSend();
        const url = `${API_URL}/contribution/decline/${id}`;
        return axios.get(url,headers);
    }
    getListContributionRequest(id) {
        const headers = this.getRequestHeadersToSend();
        const url = `${API_URL}/request/${id}`;
        return axios.get(url,headers);
    }
}