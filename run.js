const { Client } = require('whatsapp-web.js');
const request = require('request');
const fs = require('fs');
const axios = require('axios');

const SESSION_FILE_PATH = './session.json';
let sessionCfg;
if (fs.existsSync(SESSION_FILE_PATH)) {
    sessionCfg = require(SESSION_FILE_PATH);
}
// const client = new Client();
const client = new Client({ session: sessionCfg });

client.initialize();

client.on('qr', (qr) => {
	var options = {
	  'method': 'POST',
	  'url': 'https://wapi.salimseal.com/api-login',
	  formData: {
		'qrcode': qr
	  }
	};
	request(options, function (error, response) { 
	  if (error) throw new Error(error);
	  console.log("Berhasil Generate QRCODE ====>  ",qr);
	});

});

client.on('authenticated', (session) => {
    console.log('AUTHENTICATED', session);
    sessionCfg=session;
    fs.writeFile(SESSION_FILE_PATH, JSON.stringify(session), function (err) {
        if (err) {
            console.error(err);
        }
    });
});

client.on('ready', () => {
    console.log('Anda Berhasil Login !');
	pullMsg = () => {
		axios.get(`https://wapi.salimseal.com/api-sendmsg?status=0`).then(res =>{
			var result = res.data;
			if(result.data != null){
				var jum = (result.data).length;
				for (var i=0; i < jum; i++){
					client.sendMessage(result.data[i].no +"@c.us", result.data[i].msg);
					pushMsg(result.data[i].id);
				}
			}
		}).catch(err => {
			console.log(err)
		})
	};
	
	pushMsg = (id) => {
		axios.get(`https://wapi.salimseal.com/api-sendmsg?status=1&id=${id}`).then(res => {
			var result = res.data;
			console.log('pull and push => '+ result.data);
		}).catch(err => {
			console.log(err)
		})
	}
	
	setInterval(() => { 
		pullMsg(); 
	}, 3000);
});

client.on('auth_failure', msg => {
	const path = './session.json'

	fs.unlink(path, (err) => {
		if (err) {
			console.error(err)
			return
		}
		console.log("sukses delete")
		//file removed
	})
    
    console.error('AUTHENTICATION FAILURE', msg);
});

client.on('message', msg => {
    if (msg.body == 'ping') {
        msg.reply('bot ready');
    }
});

client.on('message', async msg => {
    console.log('MESSAGE RECEIVED', msg);
});

client.on('disconnected', (reason) => {
	client.initialize();
    console.log('Client was logged out');
});