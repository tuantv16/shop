module.exports = {
    devServer: {
        proxy: {
            '/api': {
                target: 'https://vapi.vnappmob.com',
                changeOrigin: true,
                pathRewrite: {
                    '^/api': ''
                }
            }
        }
    }
};
