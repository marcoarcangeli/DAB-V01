SELECT
    ProfileFeatureAuth.IdProfileFeatureAuth,
    ProfileFeatureAuth.IdProfile,
    ProfileFeatureAuth.IdFeature,
    ProfileFeatureAuth.IdAuthLevel,
    Profile.Nam AS ProfileNam,
    Feature.Nam AS FeatureNam,
    AuthLevel.Nam AS AuthLevelNam
FROM
    ProfileFeatureAuth 
LEFT OUTER JOIN Profile ON
    Profile.IdProfile = ProfileFeatureAuth.IdProfile
LEFT OUTER JOIN Feature  ON
    Feature.IdFeature = ProfileFeatureAuth.IdFeature
LEFT OUTER JOIN AuthLevel  ON
    AuthLevel.IdAuthLevel = ProfileFeatureAuth.IdAuthLevel
	
SELECT
    ProfileFeatureAuth.IdProfileFeatureAuth,
    ProfileFeatureAuth.IdProfile,
    ProfileFeatureAuth.IdFeature,
    ProfileFeatureAuth.IdAuthLevel,
    Profile.Nam AS ProfileNam,
    Feature.Nam AS FeatureNam,
    AuthLevel.Nam AS AuthLevelNam
FROM
    ProfileFeatureAuth 
LEFT OUTER JOIN Profile  ON
    Profile.IdProfile = ProfileFeatureAuth.IdProfile
LEFT OUTER JOIN Feature  ON
    Feature.IdFeature = ProfileFeatureAuth.IdFeature
LEFT OUTER JOIN AuthLevel  ON
    AuthLevel.IdAuthLevel = ProfileFeatureAuth.IdAuthLevel
WHERE
    ProfileFeatureAuth.IdProfileFeatureAuth IN(1, 6, 16);	
	