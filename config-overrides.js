const {override, addWebpackAlias, addWebpackExternals } = require('customize-cra')
const path = require('path')

module.exports = override(
    /* 由于我们使用了cdn来引入资源，所以这里的按需引入也就不需要了 */
    // fixBabelImports('import', {
    //   libraryName: 'antd',
    //   libraryDirectory: 'es',
    //   style: true,
    // }),
    // 设置路径别名
    addWebpackAlias({
        '@': path.resolve(__dirname, 'src'),
        '@components': path.resolve(__dirname, './src/components'),
        '@utils': path.resolve(__dirname, './src/utils')
    }),
    //配置cdn引入
    addWebpackExternals({
        'react': 'React',
        'react-dom': 'ReactDOM',
        'react-router-dom': 'ReactRouterDOM',
        'antd': 'antd',
        'redux': 'Redux',
        'axios': 'axios',
    }));