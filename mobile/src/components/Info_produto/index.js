import React from 'react';
import {Text, View, Image} from 'react-native';
import styles from './style';

function InfoProduto(props){
  return(

    <View style ={styles.contentView}>
      <View style ={styles.contentText}>
          <Text style ={styles.textTitle}>{props.name}</Text>

          <Image 
            style={styles.img}
            source={{uri: props.imgLink}}
          />
          
          <Text style ={styles.description}>{props.description}</Text>

          <View style={styles.itens}>
            <Text style={styles.bold}>Causas</Text>
            { 
                props.causas.map(item =>
                  <Text style={styles.item}>
                   {item.descricao}
                  </Text>
                )
            }
          </View>

          <View style={styles.itens}>
            <Text style={styles.bold}>Soluções</Text>
            { 
                props.solucoes.map(item =>
                  <Text style={styles.item}>
                   {item.descricao}
                  </Text>
                )
            }
          </View>
      </View>
    </View>
  );
}

export default InfoProduto;