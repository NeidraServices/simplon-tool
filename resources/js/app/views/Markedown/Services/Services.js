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
        const header = this.getRequestHeadersToSend()
        const url = `${API_URL}/categories`;
        return axios.get(url, header);
    }
    getByCategory(id) {
        const header = this.getRequestHeadersToSend()
        const url = `${API_URL}/markdown/category/${id}`;
        return axios.get(url, header);
    }

    getApiMdCommuns() {
        const header = this.getRequestHeadersToSend()
        const url = `${API_URL}/markdowns-commun`;
        return axios.get(url, header);
    }
    getApiMyMds() {
        const header = this.getRequestHeadersToSend()
        const url = `${API_URL}/markdown/showMine`;
        return axios.get(url,header);
    }
    getApiMyArchives(id) {
        const header = this.getRequestHeadersToSend()
        const url = `${API_URL}/markdown/archives/${id}`;
        return axios.get(url, header);
    }
    getApiMdDetails(id) {
        const header = this.getRequestHeadersToSend()
        const url = `${API_URL}/my-markdowns?id=${id}`;
        return axios.get(url, header);
    }
    updateStatus(dataSend, id) {
        const header = this.getRequestHeadersToSend()
        console.log("datatosend :"+id,dataSend)
        const url = `${API_URL}/markdown/active/${id}`;
        return axios.post(url, dataSend, header);
    }

    postCategory(data){
        const header = this.getRequestHeadersToSend()
        console.log("datatosend :"+data)
        const url = `${API_URL}/categorie/ajouter`;
        return axios.post(url, data);
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
    postAddMarkdown(data){
        const header = this.getRequestHeadersToSend()
        console.log("datatosend :"+data)
        const url = `${API_URL}/markdown/create`;
        return axios.post(url, data, header);
    }
}
