const { Client } = require('whatsapp-web.js');
var request = require('request');
const client = new Client();

client.on('qr', (qr) => {
    console.log('QR RECEIVED', qr);
	
	var options = {
	  'method': 'POST',
	  'url': 'https://sealikes.com/wapi',
	  formData: {
		'qrcode': qr
	  }
	};
	request(options, function (error, response) { 
	  if (error) throw new Error(error);
	  console.log(response.body);
	});

});

client.on('ready', () => {
    console.log('Client is ready!');

});

client.on('message', msg => {
    if (msg.body == '!ping') {
        msg.reply('pong');
    }
});

client.initialize();
