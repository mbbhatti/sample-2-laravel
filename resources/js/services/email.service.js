export const emailService = {
    sendEmail
};

function sendEmail(data) {
    return axios.post('/api/email', data)
        .then((res) => {
            return res.data;
        }).catch((error) => {
            return error.response.data.error;
        });
}