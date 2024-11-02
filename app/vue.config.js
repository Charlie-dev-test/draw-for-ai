module.exports = {
    pages: {
        index: {
            entry: 'src/main.js',
            // когда используется опция title, то <title> в шаблоне
            // должен быть <title><%= htmlWebpackPlugin.options.title %></title>
            title: 'Datamist',
        },
    }
};