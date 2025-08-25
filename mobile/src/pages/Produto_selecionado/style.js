import { StyleSheet, Dimensions } from 'react-native';
import colors from '../../styles/colors';
import metrics from '../../styles/metrics';

const {height} = Dimensions.get('window');

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: colors.fundoMain,
    alignItems: 'center'
  },

  containerSections: {
    flex: 1,
    width: '95%',
    height:'80%',
    justifyContent: 'space-between'
  },

  containerProduct: {
    marginTop: 15,
    borderRadius: 8,
    backgroundColor: colors.branco,
    elevation: 4,
  },

  containerScroll: {
    height: '100%',
  },

  containerPublicidade: {
    height: 140,
    elevation: 4,
    borderRadius: 8,
    marginBottom: 10,
    marginTop: 10,
    backgroundColor: colors.branco,
    justifyContent: 'center',
    alignItems: 'center'
  },

  textPubli: {
    textTransform: 'uppercase',
    color: colors.pretoFosco,
    fontSize: metrics.fontButton,
    fontWeight: 'bold'
  }
});

export default styles;