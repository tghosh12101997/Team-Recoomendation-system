import numpy as np
import pandas as pd
from collections import OrderedDict

class RecommenderAcad:
    def __init__(self, trait_data: pd.DataFrame, corr_list: list, threshold_list: list, team_size: int) -> None:
        """
        Parameters
        ----------
        trait_data: user(index) and trait score
        corr_list: correlations of traits [trait1, trait2, trait3, trait4, trait5]
        threshold_list: threshold of each trait [th_trait1, th_trait2, th_trait3, th_trait4, th_trait5]
        team_size: maximum no. of members in team
        """
        self.data = trait_data
        self.corr_vector = np.array(corr_list)
        self.threshold_vector = pd.Series(threshold_list, index=['type1_sum', 'type2_sum', 'type3_sum', 'type4_sum', 'type5_sum'])
        self.team_size = team_size
        pass

    def cal_acad(self) -> pd.Series:
        """
        return academic score by including correlation with trait score

        Return
        ------
        sorted pandas series of academic score with userid as index 
        """
        # get deviation vectors 
        dev = self.cal_deviation(self.data)

        # dot product of trait deviation vectors and correlation vector, and sort
        acad_score = dev.dot(self.corr_vector).sort_values(ascending=False) 
        
        return acad_score

    def cal_deviation(self,data: pd.DataFrame) -> pd.DataFrame:
        """
        calculate and return deviation of trait score from threshold

        Parameters
        ----------
        data: user(index) and trait score

        Return
        ------
        pandas dataframe containing deviation score from threshold of traits 
        """
        return data.subtract(self.threshold_vector, axis = 1) 

    def team_recommender(self,acad_data: pd.Series) -> list[list]:
        """
        find and return balanced team (comparative average score) bsed on academic score

        Parameters
        ----------
        acad_data: user(index) and academic score

        Return
        ------
        pandas dataframe containing deviation score from threshold of traits 
        """
        # convert pandas series to ordered dictionary 
        acad = acad_data.to_dict(OrderedDict)
        groups = [] # list of teams
        
        # loop until all users are placed in team
        while len(acad) > 0:
            team = []
            scr = []

            # calculate mean of academic scores
            mean = np.array(list(acad.values())).mean()
            
            # get first user and it's score as anchor point
            user1 = next(iter(acad))
            team.append(user1)
            scr.append(acad[user1])

            # delete the user
            del acad[user1]
            tol = 0.025 # mean tolerance percentage

            # loop until teams are formed or all users are placed in team
            while (len(team) < self.team_size) and (len(acad) > 0):
                old_length = len(team) # store old length of team
                for user,score in acad.copy().items():
                    scr.append(score)
                    avg = sum(scr)/len(scr)
                    if (mean - (tol * mean)) <= avg <= (mean + (tol * mean)): # compare average of team with current mean
                        team.append(user) # add user to team
                        del acad[user] # remove from original dictionary
                        break
                    else:
                        scr.pop() # if average not in tolerance range don't consider the user
                if len(team) == old_length: # check if no teammate found in a loop then increase tolerance
                    tol += 0.005
            groups.append(team)
        return groups