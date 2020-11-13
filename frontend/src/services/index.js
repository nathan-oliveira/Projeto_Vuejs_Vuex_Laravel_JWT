import axios from "axios";

const axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1:8000/api'
})

export const api = {
  get(endpoint, header) {
    if(header) return axiosInstance.get(endpoint, header);

    return axiosInstance.get(endpoint);
  },
  post(endpoint, body, header) {
    if(header) return axiosInstance.post(endpoint, body, header);

    return axiosInstance.post(endpoint, body);
  },
  delete(endpoint, header) {
    if(header) return axiosInstance.delete(endpoint, header)

    return axiosInstance.delete(endpoint)
  },
  put(endpoint, body, header) {
    if(header) return axiosInstance.put(endpoint, body, header);
    return axiosInstance.put(endpoint, body);
  }
}
