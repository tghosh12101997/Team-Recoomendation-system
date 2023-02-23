from sklearn.neighbors import NearestNeighbors
import pandas
import itertools

class RecommenderKNN:
    def __init__(self):
        self.model = NearestNeighbors()

    def set_model_params(self, n_neighbors, algorithm, metric):
        """
        set model params for sklearn.neighbors.NearestNeighbors
        Parameters
        ----------
        n_neighbors: int, optional (default = 5)
        algorithm: {'auto', 'ball_tree', 'kd_tree', 'brute'}, optional
        metric: string or callable, default 'minkowski', or one of
            ['cityblock', 'cosine', 'euclidean', 'l1', 'l2', 'manhattan']
        n_jobs: int or None, optional (default=None)
        """
        self.model.set_params(**{
            'n_neighbors': n_neighbors,
            'algorithm': algorithm,
            'metric': metric})

    def make_recommendations(self, data, n_recommendations):
        """
        return top n similar movie recommendations based on user's input movie

        Parameters
        ----------
        model: sklearn model, knn model

        data: user and responses

        n_recommendations: int, top n recommendations

        Return
        ------
        list of top n similar users
        """
        # fit
        self.model.fit(data)
        # inference
        print('Recommendation system start to make inference')
        print('......\n')
        raw_recommends = []
        distances, indices = self.model.kneighbors(
            data,
            n_neighbors=n_recommendations+1)
        # get list of raw idx of recommendations
        for i in range(len(indices)):
            raw_recommends.append( \
                sorted(
                    list(
                        zip(
                            itertools.repeat(int(data.index[i])),
                            data.index[indices[i]],
                            distances[i].squeeze().tolist()
                        )
                    ),
                    key=lambda x: x[2]
                )[:0:-1])
        return raw_recommends