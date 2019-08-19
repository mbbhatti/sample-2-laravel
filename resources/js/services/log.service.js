export const logService = {
    getLogs
};

function getLogs() {
    return axios.get('/api/logs')
        .then((res) => {
            return res.data;
        }).catch((error) => {
            return error.response.data.error;
        });
}