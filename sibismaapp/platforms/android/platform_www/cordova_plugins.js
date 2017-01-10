cordova.define('cordova/plugin_list', function(require, exports, module) {
module.exports = [
    {
        "file": "plugins/cordova-plugin-clipboard/www/client.js",
        "id": "cordova-plugin-clipboard.client",
        "clobbers": [
            "community.clipboard"
        ]
    }
];
module.exports.metadata = 
// TOP OF METADATA
{
    "cordova-plugin-whitelist": "1.2.2",
    "cordova-plugin-clipboard": "1.0.0"
};
// BOTTOM OF METADATA
});