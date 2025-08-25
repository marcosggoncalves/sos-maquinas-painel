import axios from 'axios';

const instance = axios.create({
    baseURL:'http://localhost/sos-maquinas-painel/api',
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    }
});

export default instance;