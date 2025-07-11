import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  FlatList,
  Image,
  StyleSheet,
  ActivityIndicator,
} from 'react-native';
import axios from 'axios';
import NetInfo from '@react-native-community/netinfo';

export default function App() {
  const [characters, setCharacters] = useState([]);
  const [loading, setLoading] = useState(true);
  const [erro, setErro] = useState(false);
  const [conectado, setConectado] = useState(true);

  useEffect(() => {
    const fetchCharacters = async () => {
      // Verifica conexão antes de tudo
      const net = await NetInfo.fetch();

      if (!net.isConnected) {
        console.log('Sem conexão com a internet.');
        setConectado(false);
        setLoading(false);
        return;
      }

      try {
        const response = await axios.get('https://rickandmortyapi.com/api/character');
        setCharacters(response.data.results);
        setErro(false);
      } catch (error) {
        console.error('Erro ao buscar dados:', error.message);
        setErro(true);
      } finally {
        setLoading(false);
      }
    };

    fetchCharacters();
  }, []);

  if (loading) {
    return (
      <View style={styles.centered}>
        <ActivityIndicator size="large" color="#00ff91" />
        <Text style={{ color: '#C5C6C7', marginTop: 10 }}>
          Carregando personagens...
        </Text>
      </View>
    );
  }

  if (!conectado) {
    return (
      <View style={styles.centered}>
        <Text style={styles.errorText}>🚫 Sem conexão com a internet</Text>
        <Text style={styles.errorText}>Conecte-se ao Wi-Fi ou dados móveis para continuar.</Text>
      </View>
    );
  }

  if (erro) {
    return (
      <View style={styles.centered}>
        <Text style={styles.errorText}>❌ Erro ao acessar a API.</Text>
        <Text style={styles.errorText}>Tente novamente mais tarde.</Text>
      </View>
    );
  }

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Personagens - Rick and Morty</Text>

      <FlatList
        data={characters}
        keyExtractor={(item) => item.id.toString()}
        numColumns={2}
        columnWrapperStyle={styles.row}
        contentContainerStyle={{ paddingBottom: 20 }}
        renderItem={({ item }) => (
          <View style={styles.card}>
            <Image source={{ uri: item.image }} style={styles.image} />
            <Text style={styles.name}>{item.name}</Text>
            <Text style={styles.text}>
              <Text style={styles.label}>Status:</Text> {item.status}
            </Text>
            <Text style={styles.text}>
              <Text style={styles.label}>Espécie:</Text> {item.species}
            </Text>
          </View>
        )}
      />

      <Text style={styles.footer}>Desenvolvido por wentz.dev@gmail.com</Text>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#0b0c10',
    paddingTop: 40,
    paddingHorizontal: 10,
  },
  centered: {
    flex: 1,
    backgroundColor: '#0b0c10',
    justifyContent: 'center',
    alignItems: 'center',
    padding: 20,
  },
  title: {
    color: '#00ff91',
    fontSize: 24,
    textAlign: 'center',
    marginBottom: 15,
    fontWeight: 'bold',
  },
  row: {
    justifyContent: 'space-between',
    marginBottom: 15,
  },
  card: {
    backgroundColor: '#1f2833',
    borderRadius: 10,
    padding: 10,
    marginHorizontal: 5,
    flex: 1,
    alignItems: 'center',
    shadowColor: '#45A29E',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.6,
    shadowRadius: 4,
    elevation: 4,
  },
  image: {
    width: 120,
    height: 120,
    borderRadius: 8,
    marginBottom: 10,
  },
  name: {
    color: '#66FCF1',
    fontSize: 16,
    fontWeight: 'bold',
    textAlign: 'center',
  },
  text: {
    color: '#C5C6C7',
    fontSize: 13,
    textAlign: 'center',
  },
  label: {
    fontWeight: 'bold',
    color: '#45A29E',
  },
  footer: {
    textAlign: 'center',
    paddingVertical: 15,
    color: '#45A29E',
    fontSize: 12,
  },
  errorText: {
    color: '#ff4f4f',
    fontSize: 16,
    textAlign: 'center',
    marginBottom: 10,
  },
});
