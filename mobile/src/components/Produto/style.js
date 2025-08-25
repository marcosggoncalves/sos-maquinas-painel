import {StyleSheet, Dimensions } from 'react-native';
import colors from '../../styles/colors';
import metrics from '../../styles/metrics';

const {width} = Dimensions.get('window');
const styles = StyleSheet.create({

  containerItem: {
    width: (width / 3) - 15,
    height: 115,
    backgroundColor: '#000',
    borderRadius: 5,
    marginBottom: 5,
    marginLeft: 4
  },

  imgProduto: {
    position: 'absolute',
    width: '100%',
    height: '100%',
    resizeMode: 'contain'
  },

  textLegenda: {
    backgroundColor: colors.branco,
    position: 'absolute',
    bottom: 0,
    width: '100%',
    height: 25,
    textAlign: 'center',
    fontWeight: 'bold',
    justifyContent: 'center',
    alignItems: 'center',
    fontSize: metrics.fontImput,
    opacity: 0.94
  }
});

export default styles;