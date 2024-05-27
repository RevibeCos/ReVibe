import axios, { AxiosInstance } from "axios";
import { read_cookie } from "sfcookies";

export const instance = (baseURL: string) => {
    const axiosInstance = axios.create({
        baseURL,
        headers: {
            "Content-Type": "application/json",
        },
    });

    return axiosInstance;
};

export enum INSTANCES {
    BASE = "BASE",
}

class AxiosService {
    static instance: AxiosService;

    [INSTANCES.BASE]: AxiosInstance;

    constructor() {
        this.BASE = this.initInstance();
    }

    static getInstance() {
        if (!AxiosService.instance) {
            AxiosService.instance = new AxiosService();
        }

        return AxiosService.instance;
    }

    initInstance() {
        const axios = instance("http://localhost:8000/");
        axios.interceptors.request.use(
            async (config) => {
                const token = read_cookie("token");

                if (
                    config &&
                    config.headers &&
                    !config.headers.Authorization &&
                    token
                ) {
                    config.headers.Authorization = `Bearer ${token}`;
                }
                return config;
            },
            (error) => {
                return Promise.reject(error);
            }
        );
        return axios;
    }
}

export default AxiosService.getInstance();
