import React,{Component} from 'react';
import { View, Text, ScrollView, AsyncStorage, RefreshControl} from 'react-native';
import styles from './style';
import InfoProduto from '../../components/Info_produto';
import Carousel from '../../components/Carousel/Carousel';
import {findAll} from '../../services/index';
import sincronizar from '../../sincronizar';


export default class Produto_selecionado extends React.Component {
  constructor(props) {
    super(props)
    this.state = {
      simbolo: {},
      causas:[],
      solucoes:[],
      refreshing: false
    };
  }

   _onRefresh = ()=>{
    sincronizar();
    
    this.setState({refreshing: true});

    setTimeout(()=>{
       this.setState({refreshing: false});  
       this.getItens();
    },2000)

    clearTimeout();
  }

  async getItens(){
    const { simbolo } = this.props.route.params;

    this.setState({simbolo:simbolo});

    const getCausas = await findAll(`simbolos_items where categoria_simbolo_id = ${simbolo.id} and tipo = 'Causa'`);
    const getSolucoes = await findAll(`simbolos_items where categoria_simbolo_id = ${simbolo.id} and tipo = 'Solução'`);

    this.setState(prevState => {
      prevState.causas = getCausas._array;
      prevState.solucoes = getSolucoes._array;
      return prevState;
    });

  }

  componentDidMount(){
   this.getItens();
  }

  ComponentDidUpdate(){
   this.getItens();
  }

  render(){
    const { simbolo, solucoes, causas, refreshing } = this.state;

    return(
      <ScrollView refreshControl={
          <RefreshControl
            refreshing={refreshing}
            onRefresh={this._onRefresh}
          />
        }>
        <View style ={styles.container}>

          <View style = {styles.containerSections}>
            <View style ={styles.containerProduct}>       
  
                <InfoProduto 
                  imgLink ={"http://www.tegy.com.br/public/" + simbolo.imagem}
                  name ={simbolo.titulo}
                  description ={simbolo.descricao}
                  solucoes={solucoes}
                  causas={causas}
                  key={simbolo.id}
                />
        
            </View>
            
            <View style = {styles.containerPublicidade}>
              <Carousel />
            </View>
          </View>
        </View>
      </ScrollView>
    );
  }
}
