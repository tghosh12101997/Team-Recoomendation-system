import mysql.connector
import pandas as pd
from RecommenderKNN import RecommenderKNN
from RecommenderAcad import RecommenderAcad

# DB connection config
mydb = mysql.connector.connect(
  host="148.66.137.119",
  user="i4014151_wp2",
  password="infotech",
  database="i4014151_wp2"
)

# get data methods

# get all the responses of users from DB
def get_response_data():
        cursor = mydb.cursor()
        cursor.execute(''' SELECT user_id, question_id, ans_id, MAX(created_on) as created_on FROM dbse_responses GROUP BY user_id, question_id ORDER BY user_id, question_id''')
        data = pd.DataFrame(cursor.fetchall())
        data.columns = cursor.column_names
        processed_data = data_preprocess(data, response_data = True)
        cursor.close()
        return processed_data

# get the trait scores from DB
def get_trait_data():
        cursor = mydb.cursor()
        cursor.execute(''' SELECT user_id, type1_sum, type2_sum, type3_sum, type4_sum, type5_sum FROM dbse_result WHERE type1_sum IS NOT NULL AND type2_sum IS NOT NULL AND type3_sum IS NOT NULL AND type4_sum IS NOT NULL AND type5_sum IS NOT NULL ORDER BY user_id ''')
        data = pd.DataFrame(cursor.fetchall())
        data.columns = cursor.column_names
        processed_data = data_preprocess(data, response_data = False)
        cursor.close()
        return processed_data

# process fetched data
def data_preprocess(data, response_data):
    if response_data:
        del data['created_on']
        new_data = data.pivot_table(values='ans_id', index='user_id', columns='question_id')
    else:
        new_data = data.set_index('user_id', drop=True)
    return new_data

# insert data methods

# insert recommendations based on user responses from first recommender
def insert_response_recommendation(results):
    cursor = mydb.cursor()
    for value in results:
        records = ', '.join(map(str, value))
        sql = "INSERT INTO dbse_recommendation (user_id, recommendation, distance) VALUES {}".format(records)
        cursor.execute(sql)
        mydb.commit()
        print(cursor.rowcount, " recommendations were inserted.")
    cursor.close()
    pass

# insert academic scores of users from second recommender
def insert_acadscore(results):
    cursor = mydb.cursor()
    records = ', '.join(map(str, results))
    sql = "INSERT INTO dbse_acads (user_id, acad_score) VALUES {}".format(records)
    cursor.execute(sql)
    mydb.commit()
    print(cursor.rowcount, " acad scores were inserted.")
    cursor.close()
    pass

# insert recommendations based on user trait scores from first recommender
def insert_acad_recommendation(results):
    cursor = mydb.cursor()
    for value in results:
        records = ', '.join(map(str, value))
        sql = "INSERT INTO dbse_recommendation_1 (team) VALUES ('{}')".format(records)
        cursor.execute(sql)
        mydb.commit()
        print(cursor.rowcount, " team is inserted.")
    cursor.close()
    pass

# recommendation generator
def generate_recommendation():
    # First recommender
    response_data = get_response_data()
    recommender1 = RecommenderKNN()
    k = len(response_data) - 1
    recommender1.set_model_params(k, 'brute', 'cosine')
    recommendations1 = recommender1.make_recommendations(response_data, k)
    insert_response_recommendation(recommendations1)

    # Second recommender
    trait_data = get_trait_data()

    # [trait1, trait2, trait3, trait4, trait5]
    # [Agreeableness, Openness to Experience, Neuroticism, Extraversion, Conscientiousness]
    # ['tough-tender', 'success-risk', 'optimist-pessimist', 'communicating and role', 'managing people and resources']
    corr = [0.06, 0.06, 0.03, -0.05 ,0.24]
    threshold = [65, 40, 65, 50, 50]
    teamsize = 3
    recommender2 = RecommenderAcad(trait_data,corr,threshold,teamsize)
    acad_score = recommender2.cal_acad()
    teams = recommender2.team_recommender(acad_score)
    insert_acadscore(list(zip(acad_score.index, acad_score)))
    insert_acad_recommendation(teams)
    pass

generate_recommendation()