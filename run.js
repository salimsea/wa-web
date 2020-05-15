const { Client } = require('whatsapp-web.js');
var request = require('request');
const client = new Client();
// const client = new Client({ puppeteer: { headless: false } });

client.initialize();

client.on('qr', (qr) => {
	let data = 'stackabuse.com';
	let buff = new Buffer(qr);
	let base64data = buff.toString('base64');
	var options = {
	  'method': 'POST',
	  'url': 'https://sealikes.com/wapi',
	  formData: {
		'qrcode': base64data
	  }
	};
	request(options, function (error, response) { 
	  if (error) throw new Error(error);
	  console.log("Berhasil Generate QRCODE ====>  ",base64data);
	});

});

client.on('ready', () => {
    console.log('\x1b[32m', 'Anda Berhasil Login !');

});

client.on('auth_failure', msg => {
    client.initialize();
    console.error('AUTHENTICATION FAILURE', msg);
});

client.on('message', msg => {
    if (msg.body == '!ping') {
        msg.reply('pong');
    }
});

client.on('message', async msg => {
    console.log('MESSAGE RECEIVED', msg);
});

client.on('disconnected', (reason) => {
	client.initialize();
    console.log('Client was logged out');
});