import React, { Component } from 'react';
import {AsyncStorage, ToastAndroid, Alert } from 'react-native';
import NetInfo from '@react-native-community/netinfo';

import {atualizar, deletar} from './services/index';
import api from './axios';

const sincronizar = ()=>{
	NetInfo.fetch().then(state => {
		if(!state.isConnected){
			ToastAndroid.showWithGravity(
		      "Não foi possivel buscar atualizações, não foi encontrada nenhuma conexão com a intenet!",
		      ToastAndroid.SHORT,
		      ToastAndroid.CENTER
		    );
		}else{
			api.get('/sincronizar').then((res) =>{
	 		if(res.data.status){
	 			api.get('/data').then((data) =>{
	 				
	 				deletar();
		            atualizar(data.data.publicidades);
		            atualizar(data.data.categorias);
		            atualizar(data.data.simbolos);
		            atualizar(data.data.simbolosItens);

		         	ToastAndroid.showWithGravity(
				      res.data.message,
				      ToastAndroid.SHORT,
				      ToastAndroid.CENTER
				 	);
		        }).catch(err => {
			        ToastAndroid.showWithGravity(
				      "Ocorreu um erro ao tentar sincronizar dados, tente novamente!",
				      ToastAndroid.SHORT,
				      ToastAndroid.CENTER
				    );
		        });
	 		}else{
	 			ToastAndroid.showWithGravity(
			      res.data.message,
			      ToastAndroid.SHORT,
			      ToastAndroid.CENTER
			    );
	 		}
	    }).catch(err => {
	      Alert.alert(
	        "Atenção",
	        "Ocorreu um erro ao tentar sincronizar dados, tente novamente!",
	      );
	    });
		}
	});
}

export default sincronizar;