import Axios from "axios";

export const apiService = {
    get(url, data = {}) {
        // console.log("URL :", url)
        return Axios({
            method: 'get',
            url: url,
            params: data,
            headers: headers()
        })
    },
    post(url, data = {}) {
        return Axios({
            method: 'post',
            url: url,
            data: data,
            headers: headers()
        })
    },
    put(url, data = {}) {
        return Axios({
            method: 'put',
            url: url,
            data: data,
            headers: headers()
        })
    },
    delete(url, data = {}) {
        return Axios({
            method: 'delete',
            url: url,
            params: data,
            headers: headers()

        })
    },
}

function headers() {
    const authHeader = localStorage.getItem('token')
        ? { Authorization: "Bearer " + localStorage.getItem('token') }
        : {};
    return {
        ...authHeader,
        "Content-Type": "application/json"
    }
}